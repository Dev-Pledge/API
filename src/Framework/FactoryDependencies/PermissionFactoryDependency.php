<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PermissionFactory;
use DevPledge\Domain\Permission;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class PermissionFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PermissionFactoryDependency extends AbstractFactoryDependency {
	/**
	 * PermissionFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PermissionFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PermissionFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new PermissionFactory( Permission::class, 'permission', 'permission_id' );
	}



	/**
	 * usually return static::getFromContainer();
	 * @return mixed
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}