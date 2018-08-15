<?php

namespace DevPledge\Application\Service;


use DevPledge\Domain\PaymentException;
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
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function stripePay( string $pledgeId, string $token, float $value, string $currency ) {
		/**
		 * @var $gateway Gateway
		 */
		return $this->handleGatewayResponse(
			$this->getPledge( $pledgeId ),
			$this->gateway->purchase( [
				'amount'   => $value,
				'currency' => $currency,
				'token'    => $token,
			] )->send() );
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
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function cardPay( string $pledgeId, int $cardNumber, int $expiryMonth, int $expiryYear, int $cvv, float $value, string $currency ) {
		$formData = [
			'number'      => $cardNumber,
			'expiryMonth' => $expiryMonth,
			'expiryYear'  => $expiryYear,
			'cvv'         => $cvv
		];

		return $this->handleGatewayResponse(
			$this->getPledge( $pledgeId ),
			$this->gateway->purchase(
				[
					'amount'   => $value,
					'currency' => $currency,
					'card'     => $formData
				]
			)->send() );

	}

	/**
	 * @param $pledgeId
	 *
	 * @return \DevPledge\Domain\Pledge
	 * @throws PaymentException
	 */
	protected function getPledge( $pledgeId ) {
		$pledge = $this->pledgeService->read( $pledgeId );

		if ( ! $pledge->isPersistedDataFound() ) {
			throw new PaymentException( 'Unable to make payment on Pledge' );
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
	protected function handleGatewayResponse( Pledge $pledge, ResponseInterface $response ): bool {


		if ( $response->isRedirect() ) {
			throw new PaymentException( $response->getMessage(), $response->getRedirectUrl() );
		} elseif ( $response->isSuccessful() ) {
			$this->pledgeService->update( $pledge, (object) [
				'payment_gateway'   => get_class( $this->gateway ),
				'payment_reference' => $response->getTransactionReference()
			] );
		} else {
			throw new PaymentException( $response->getMessage() );
		}

		return true;
	}
}