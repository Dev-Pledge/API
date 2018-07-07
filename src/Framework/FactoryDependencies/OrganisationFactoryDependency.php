<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\OrganisationFactory;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class OrganisationFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class OrganisationFactoryDependency extends AbstractFactoryDependency {
	/**
	 * OrganisationFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( OrganisationFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return OrganisationFactory
	 */
	public function __invoke( Container $container ) {
		return new OrganisationFactory();
	}


	/**
	 * @return OrganisationFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}