<?php


namespace DevPledge\Application\Factory;

use DevPledge\Uuid\Uuid;

/**
 * Class PermissionFactory
 * @package DevPledge\Application\Factory
 */
class PermissionFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|PermissionFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'permission_id', 'setUuid', Uuid::class )
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'resource', 'setResource' )
			->setMethodToProductObject( 'resource_id', 'setResourceId' )
			->setMethodToProductObject( 'action', 'setAction' );
	}
}