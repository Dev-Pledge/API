<?php

namespace DevPledge\Application\Factory;

use DevPledge\Uuid\DualUuid;

/**
 * Class FollowFactory
 * @package DevPledge\Application\Factory
 */
class FollowFactory extends AbstractFactory {
	/**
	 * @param bool $fromPersistedData
	 *
	 * @return $this|AbstractFactory
	 * @throws FactoryException
	 */
	public function setUuid( $fromPersistedData = false ) {
		try {
			$this->setMethodToProductObject( [
				'user_id',
				'id'
			],
				'setDualUuid',
				DualUuid::class,
				function ( AbstractDomain $domain ) use ( $fromPersistedData ) {
					if ( $fromPersistedData ) {
						$domain->setPersistedDataFound( true );
					}
				} );
		} catch ( \InvalidArgumentException $exception ) {
			throw new FactoryException( $exception->getMessage() );
		}

		return $this;
	}

	/**
	 * @return AbstractFactory|FollowFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this;
	}
}