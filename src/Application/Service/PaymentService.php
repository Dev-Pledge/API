<?php

namespace DevPledge\Application\Service;

use DevPledge\Application\Factory\PaymentFactory;
use DevPledge\Application\Repository\PaymentRepository;
use DevPledge\Domain\CurrencyValue;
use DevPledge\Domain\Payment;
use DevPledge\Domain\PaymentException;
use DevPledge\Integrations\Sentry;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Stripe\Gateway;

/**
 * Class PaymentService
 * @package DevPledge\Application\Service
 */
class PaymentService {
	/**
	 * @var Gateway
	 */
	protected $gateway;
	/**
	 * @var PaymentRepository
	 */
	protected $repo;
	/**
	 * @var PaymentFactory
	 */
	protected $factory;

	/**
	 * PaymentService constructor.
	 *
	 * @param PaymentRepository $repo
	 * @param PaymentFactory $factory
	 * @param AbstractGateway $gateway
	 */
	public function __construct( PaymentRepository $repo, PaymentFactory $factory, AbstractGateway $gateway ) {
		$this->repo    = $repo;
		$this->factory = $factory;
		$this->gateway = $gateway;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Payment
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Payment {

		$pledge = $this->factory->create( $data );

		$pledge = $this->repo->createPersist( $pledge );

		return $pledge;
	}

	/**
	 * @param Payment $payment
	 * @param \stdClass $rawUpdateData
	 *
	 * @return Payment
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Payment $payment, \stdClass $rawUpdateData ): Payment {
		$pledge = $this->factory->update( $payment, $rawUpdateData );

		return $this->repo->update( $pledge );
	}

	/**
	 * @param string $paymentId
	 *
	 * @return Payment
	 */
	public function read( string $paymentId ): Payment {
		return $this->repo->read( $paymentId );
	}

	/**
	 * @param string $paymentId
	 *
	 * @return int|null
	 */
	public function delete( string $paymentId ): ?int {
		return $this->repo->delete( $paymentId );
	}


	/**
	 * @param ResponseInterface $response
	 * @param \Closure|null $successfulFunction
	 * @param CurrencyValue|null $createPayment
	 *
	 * @return bool
	 * @throws PaymentException
	 */
	protected function handleGatewayResponse( ResponseInterface $response, ?\Closure $successfulFunction = null, ?CurrencyValue $createPayment = null ): bool {

		if ( $response->isRedirect() ) {
			throw new PaymentException( $response->getMessage(), $response->getRedirectUrl() );
		} elseif ( $response->isSuccessful() ) {
			if ( isset( $successfulFunction ) ) {
				$payment = null;
				if ( isset( $createPayment ) ) {
					$payment = $this->create( (object) [
						'gateway'   => $this->gateway->getShortName(),
						'reference' => $response->getTransactionReference(),
						'data'      => json_encode( $response->getData() ),
						'value'     => $createPayment->getValue(),
						'currency'  => $createPayment->getValue()
					] );
				}
				call_user_func_array( $successfulFunction, [ $response, $payment ] );

			}
		} else {
			throw new PaymentException( $response->getMessage() );
		}

		return true;
	}

	/**
	 * @param int $cardNumber
	 * @param int $expiryMonth
	 * @param int $expiryYear
	 * @param int $cvv
	 * @param CurrencyValue $currencyValue
	 * @param \Closure|null $successFunction
	 *
	 * @return bool
	 * @throws PaymentException
	 */
	public function cardPay( int $cardNumber, int $expiryMonth, int $expiryYear, int $cvv, CurrencyValue $currencyValue, ?\Closure $successFunction = null ) {
		$formData = [
			'number'      => $cardNumber,
			'expiryMonth' => $expiryMonth,
			'expiryYear'  => $expiryYear,
			'cvv'         => $cvv
		];
		try {
			return $this->handleGatewayResponse(
				$this->gateway->purchase(
					[
						'amount'   => $currencyValue->getValue(),
						'currency' => $currencyValue->getCurrency(),
						'card'     => $formData
					]
				)->send(),
				$successFunction,
				$currencyValue
			);
		} catch ( \TypeError  | \Exception $exception ) {
			Sentry::get()->captureException( $exception );
			throw new PaymentException( 'Data being used is incorrect!' );
		}
	}

	/**
	 * @param string $token
	 * @param CurrencyValue $currencyValue
	 * @param \Closure|null $successFunction
	 *
	 * @return bool
	 * @throws PaymentException
	 */
	public function stripePayWithToken( string $token, CurrencyValue $currencyValue, ?\Closure $successFunction = null ) {

		try {
			return $this->handleGatewayResponse(
				$this->gateway->purchase( [
					'amount'   => $currencyValue->getValue(),
					'currency' => $currencyValue->getCurrency(),
					'token'    => $token,
				] )->send(), $successFunction, $currencyValue );
		} catch ( \TypeError  | \Exception  $exception ) {
			Sentry::get()->captureException( $exception );
			throw new PaymentException( 'Data being used is incorrect!' );
		}
	}


}