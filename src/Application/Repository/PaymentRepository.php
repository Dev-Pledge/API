<?php

namespace DevPledge\Application\Repository;

/**
 * Class PaymentRepository
 * @package DevPledge\Application\Repository
 */
class PaymentRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'payments';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'payment_id';
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