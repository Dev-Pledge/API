<?php


namespace DevPledge\Framework\RepositoryDependencies\Permission;


use DevPledge\Application\Repository\PermissionRepository;
use DevPledge\Framework\FactoryDependencies\PermissionFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

class PermissionRepositoryDependency extends AbstractRepositoryDependency {

	public function __construct() {
		parent::__construct( PermissionRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PermissionRepository
	 */
	public function __invoke( Container $container ) {
		$factory = PermissionFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );

		return new PermissionRepository( $adaptor, $factory );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PermissionRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}