<?php

namespace DevPledge\Framework\ServiceProviders;

use DevPledge\Application\Services\OrganisationService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class OrganisationServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class OrganisationServiceProvider extends AbstractServiceProvider {

	public function __construct() {
		parent::__construct( OrganisationService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return OrganisationService
	 */
	public function __invoke( Container $container ) {
		return new OrganisationService(
			OrganisationRepositoryDependency::getRepository(),
			OrganisationFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return OrganisationService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}