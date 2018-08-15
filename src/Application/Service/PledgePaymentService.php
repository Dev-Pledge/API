<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\PaymentException;
use DevPledge\Domain\Pledge;
use DevPledge\Domain\RefundException;
use DevPledge\Integrations\Sentry;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Stripe\Gateway;

/**
 * Class PaymentService
 * @package DevPledge\Application\Service
 */
class PledgePaymentService {
	/**
	 * @var Gateway
	 */
	protected $gateway;
	/**
	 * @var PledgeService
	 */
	protected $pledgeService;

	/**
	 * PledgePaymentService constructor.
	 *
	 * @param AbstractGateway $gateway
	 * @param PledgeService $pledgeService
	 */
	public function __construct( AbstractGateway $gateway, PledgeService $pledgeService ) {
		$this->gateway       = $gateway;
		$this->pledgeService = $pledgeService;
	}

	/**
	 * @param string $pledgeId
	 * @param string $token
	 * @param float $value
	 * @param string $currency
	 *
	 * @return bool
	 * @throws PaymentException
	 */
	public function stripePay( string $pledgeId, string $token, float $value, string $currency ) {

		try {
			return $this->handleGatewayResponse(
				$this->getPledge( $pledgeId ),
				$this->gateway->purchase( [
					'amount'   => $value,
					'currency' => $currency,
					'token'    => $token,
				] )->send() );
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
			throw new PaymentException( 'Data being used is incorrect!' );
		}
	}

	/**
	 * @param string $pledgeId
	 * @param int $cardNumber
	 * @param int $expiryMonth
	 * @param int $expiryYear
	 * @param int $cvv
	 * @param float $value
	 * @param string $currency
	 *
	 * @return bool
	 * @throws PaymentException
	 */
	public function cardPay( string $pledgeId, int $cardNumber, int $expiryMonth, int $expiryYear, int $cvv, float $value, string $currency ) {
		$formData = [
			'number'      => $cardNumber,
			'expiryMonth' => $expiryMonth,
			'expiryYear'  => $expiryYear,
			'cvv'         => $cvv
		];
		try {
			return $this->handleGatewayResponse(
				$this->getPledge( $pledgeId ),
				$this->gateway->purchase(
					[
						'amount'   => $value,
						'currency' => $currency,
						'card'     => $formData
					]
				)->send(), function ( $pledge, $response ) {
				$this->pledgeService->update( $pledge, (object) [
					'payment_gateway'   => get_class( $this->gateway ),
					'payment_reference' => $response->getTransactionReference()
				] );
			} );
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
			throw new PaymentException( 'Data being used is incorrect!' );
		}
	}

	/**
	 * @param string $pledgeId
	 * @param string $throwClass
	 *
	 * @return Pledge
	 */
	protected function getPledge( string $pledgeId, string $throwClass = PaymentException::class ): Pledge {
		$pledge = $this->pledgeService->read( $pledgeId );

		if ( ! $pledge->isPersistedDataFound() ) {
			throw new $throwClass( 'Unable to make payment on Pledge' );
		}

		return $pledge;
	}

	/**
	 * @param Pledge $pledge
	 * @param ResponseInterface $response
	 *
	 * @return bool
	 * @throws PaymentException
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	protected function handleGatewayResponse( Pledge $pledge, ResponseInterface $response, \Closure $successfulFunction ): bool {


		if ( $response->isRedirect() ) {
			throw new PaymentException( $response->getMessage(), $response->getRedirectUrl() );
		} elseif ( $response->isSuccessful() ) {

			call_user_func_array( $successfulFunction, [ $pledge, $response ] );

		} else {
			throw new PaymentException( $response->getMessage() );
		}

		return true;
	}

	/**
	 * @param string $pledgeId
	 *
	 * @return bool
	 * @throws FactoryException
	 * @throws PaymentException | RefundException
	 */
	public function refund( string $pledgeId ) {
		return $this->handleGatewayResponse(
			$pledge = $this->getPledge( $pledgeId ),
			$this->gateway->refund( [
				'transactionReference' => $pledge->getPaymentReference(),
				'amount'               => $pledge->getCurrencyValue()->getValue(),
				'currency'             => $pledge->getCurrencyValue()->getCurrency()
			] )->send(),
			function ( $pledge ) {
				$this->pledgeService->update( $pledge, (object) [
					'refunded' => 1
				] );
			} );
	}
}