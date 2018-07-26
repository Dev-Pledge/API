<?php


namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PermissionFactory;
use DevPledge\Domain\Permission;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class PermissionFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PermissionFactoryDependency extends AbstractRepositoryDependency {
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
	 * @return PermissionFactory
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}