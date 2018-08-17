<?php

namespace DevPledge\Application\Repository;

/**
 * Class PaymentMethodRepository
 * @package DevPledge\Application\Repository
 */
class PaymentMethodRepository extends AbstractRepository {

	/**
	 * @return string
	 */
	protected function getResource(): string {
		return 'payment_method';
	}

	/**
	 * @return string
	 */
	protected function getColumn(): string {
		return 'payment_method_id';
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