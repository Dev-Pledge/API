<?php

namespace DevPledge\Framework\RepositoryDependencies;


use DevPledge\Application\Mapper\Mapper;
use DevPledge\Application\Repository\UserRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

/**
 * Class UserRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies
 */
class UserRepositoryDependency extends AbstractRepositoryDependency {

	public function __construct() {
		parent::__construct( UserRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserRepository
	 */
	public function __invoke( Container $container ) {
		$factory = UserFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );

		return new UserRepository( $adaptor, $factory );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}