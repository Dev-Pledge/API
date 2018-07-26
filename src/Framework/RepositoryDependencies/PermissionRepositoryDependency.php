<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 26/07/2018
 * Time: 00:20
 */

namespace DevPledge\Framework\RepositoryDependencies;


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