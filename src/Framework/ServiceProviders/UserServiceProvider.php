<?php


namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\UserService;
use DevPledge\Domain\Role\Member;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\User\UserRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\JWTServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\RedisServiceProvider;
use Slim\Container;

/**
 * Class UserServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class UserServiceProvider extends AbstractServiceProvider {


	public function __construct() {
		parent::__construct( UserService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserService
	 */
	public function __invoke( Container $container ) {
		return new UserService(
			UserRepositoryDependency::getRepository(),
			UserFactoryDependency::getFactory(),
			CacheServiceProvider::getService(),
			new Member(),
			JWTServiceProvider::getService()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}