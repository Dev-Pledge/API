<?php

namespace DevPledge\Application\Service;

use DevPaymentMethod\Domain\PaymentMethods;
use DevPledge\Application\Factory\PaymentMethodFactory;
use DevPledge\Application\Repository\PaymentMethodRepository;
use DevPledge\Domain\PaymentMethod;
use DevPledge\Framework\Adapter\Where;

/**
 * Class PaymentMethodService
 * @package DevPledge\Application\Service
 */
class PaymentMethodService {

	/**
	 * @var PaymentMethodRepository
	 */
	protected $repo;
	/**
	 * @var PaymentMethodFactory
	 */
	protected $factory;

	/**
	 * PaymentMethodService constructor.
	 *
	 * @param PaymentMethodRepository $repo
	 * @param PaymentMethodFactory $factory
	 * @param AbstractGateway $gateway
	 */
	public function __construct( PaymentMethodRepository $repo, PaymentMethodFactory $factory ) {
		$this->repo    = $repo;
		$this->factory = $factory;
	}


	/**
	 * @param \stdClass $data
	 *
	 * @return PaymentMethod
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): PaymentMethod {

		$paymentMethod = $this->factory->create( $data );

		$paymentMethod = $this->repo->createPersist( $paymentMethod );

		return $paymentMethod;
	}

	/**
	 * @param PaymentMethod $paymentMethod
	 * @param \stdClass $rawUpdateData
	 *
	 * @return PaymentMethod
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( PaymentMethod $paymentMethod, \stdClass $rawUpdateData ): PaymentMethod {
		$paymentMethod = $this->factory->update( $paymentMethod, $rawUpdateData );

		return $this->repo->update( $paymentMethod );
	}

	/**
	 * @param string $paymentMethodId
	 *
	 * @return PaymentMethod
	 */
	public function read( string $paymentMethodId ): PaymentMethod {
		return $this->repo->read( $paymentMethodId );
	}

	/**
	 * @param string $paymentMethodId
	 *
	 * @return int|null
	 */
	public function delete( string $paymentMethodId ): ?int {
		return $this->repo->delete( $paymentMethodId );
	}

	/**
	 * @param string $userId
	 *
	 * @return PaymentMethods
	 * @throws \Exception
	 */
	public function getUserPaymentMethods( string $userId ): PaymentMethods {
		$paymentMethods = $this->repo->readAll( $userId, 'created', true );
		if ( $paymentMethods ) {
			return new PaymentMethods( $paymentMethods );
		}

		return new PaymentMethods( [] );
	}

	/**
	 * @param $organisationId
	 *
	 * @return PaymentMethods
	 * @throws \Exception
	 */
	public function getOrganisationPaymentMethods( $organisationId ): PaymentMethods {
		$paymentMethods = $this->repo->readAllWhere( new Wheres( [
			new Where( 'organisation_id', $organisationId )
		] ), 'created', true );
		if ( $paymentMethods ) {
			return new PaymentMethods( $paymentMethods );
		}

		return new PaymentMethods( [] );
	}


}