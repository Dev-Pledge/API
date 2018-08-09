<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\SolutionService;
use DevPledge\Framework\FactoryDependencies\SolutionFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Problem\SolutionRepoDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Container;

/**
 * Class SolutionServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class SolutionServiceProvider extends AbstractServiceProvider {
	/**
	 * SolutionServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( SolutionService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return SolutionService
	 */
	public function __invoke( Container $container ) {

		return new SolutionService(
			SolutionRepoDependency::getRepository(),
			SolutionFactoryDependency::getFactory(),
			UserServiceProvider::getService()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return SolutionService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}