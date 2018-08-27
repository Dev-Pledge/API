<?php

namespace DevPledge\Framework\RepositoryDependencies\User;


use DevPledge\Application\Repository\FollowRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\FollowFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

/**
 * Class FollowRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies
 */
class FollowRepositoryDependency extends AbstractRepositoryDependency {

	public function __construct() {
		parent::__construct( FollowRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return FollowRepository
	 */
	public function __invoke( Container $container ) {
		$factory = FollowFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );

		return new FollowRepository( $adaptor, $factory );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return FollowRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}