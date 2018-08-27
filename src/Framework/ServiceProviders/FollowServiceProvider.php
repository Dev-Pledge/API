<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\FollowService;
use DevPledge\Framework\FactoryDependencies\FollowFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\User\FollowRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Container;

/**
 * Class FollowServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class FollowServiceProvider extends AbstractServiceProvider {
	/**
	 * FollowServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( FollowService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return FollowService
	 */
	public function __invoke( Container $container ) {
		return new FollowService(
			FollowRepositoryDependency::getRepository(),
			FollowFactoryDependency::getFactory(),
			UserServiceProvider::getService(),
			CacheServiceProvider::getService()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return FollowService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}