<?php

namespace DevPledge\Application\Repository;

/**
 * Class PaymentMeansRepository
 * @package DevPledge\Application\Repository
 */
class PaymentMeansRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'payment_means';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'payment_means_id';
	}

	/**
	 * @return string
	 */
	protected function getAllColumn(): string {
		return 'user_id';
	}

	/**
	 * @return AbstractRepository|null
	 */
	protected function getMapRepository(): ?AbstractRepository {
		return null;
	}
}