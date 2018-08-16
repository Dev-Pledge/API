<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\PledgeService;
use DevPledge\Framework\FactoryDependencies\PledgeFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Problem\PledgeRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class PledgeServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class PledgeServiceProvider extends AbstractServiceProvider {
	/**
	 * PledgeServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( PledgeService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PledgeService
	 */
	public function __invoke( Container $container ) {
		return new PledgeService(
			PledgeRepositoryDependency::getRepository(),
			PledgeFactoryDependency::getFactory(),
			UserServiceProvider::getService(),
			SolutionServiceProvider::getService(),
			PaymentServiceProvider::getService()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PledgeService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}