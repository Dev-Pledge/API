<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class UserFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class UserFactoryDependency extends AbstractFactoryDependency {
	/**
	 * UserFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( UserFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserFactory
	 */
	public function __invoke( Container $container ) {
		return new UserFactory();
	}


	/**
	 * @return UserFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}