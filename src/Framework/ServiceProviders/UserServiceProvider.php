<?php


namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\UserService;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\UserRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
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
	 * @return mixed
	 */
	public function __invoke( Container $container ) {

		return new UserService( UserRepositoryDependency::getRepository(), UserFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}