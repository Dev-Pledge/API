<?php

namespace DevPledge\Application\Service;

use DevPledge\Application\Factory\PaymentMeansFactory;
use DevPledge\Application\Repository\PaymentMeansRepository;
use DevPledge\Domain\PaymentMeans;

/**
 * Class PaymentMeansService
 * @package DevPledge\Application\Service
 */
class PaymentMeansService {

	/**
	 * @var PaymentMeansRepository
	 */
	protected $repo;
	/**
	 * @var PaymentMeansFactory
	 */
	protected $factory;

	/**
	 * PaymentMeansService constructor.
	 *
	 * @param PaymentMeansRepository $repo
	 * @param PaymentMeansFactory $factory
	 * @param AbstractGateway $gateway
	 */
	public function __construct( PaymentMeansRepository $repo, PaymentMeansFactory $factory ) {
		$this->repo    = $repo;
		$this->factory = $factory;
	}


	/**
	 * @param \stdClass $data
	 *
	 * @return PaymentMeans
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): PaymentMeans {

		$paymentMeans = $this->factory->create( $data );

		$paymentMeans = $this->repo->createPersist( $paymentMeans );

		return $paymentMeans;
	}

	/**
	 * @param PaymentMeans $paymentMeans
	 * @param \stdClass $rawUpdateData
	 *
	 * @return PaymentMeans
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( PaymentMeans $paymentMeans, \stdClass $rawUpdateData ): PaymentMeans {
		$paymentMeans = $this->factory->update( $paymentMeans, $rawUpdateData );

		return $this->repo->update( $paymentMeans );
	}

	/**
	 * @param string $paymentMeansId
	 *
	 * @return PaymentMeans
	 */
	public function read( string $paymentMeansId ): PaymentMeans {
		return $this->repo->read( $paymentMeansId );
	}

	/**
	 * @param string $paymentMeansId
	 *
	 * @return int|null
	 */
	public function delete( string $paymentMeansId ): ?int {
		return $this->repo->delete( $paymentMeansId );
	}


}