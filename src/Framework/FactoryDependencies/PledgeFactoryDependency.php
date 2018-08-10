<?php


namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\PledgeFactory;
use DevPledge\Domain\Pledge;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class PledgeFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class PledgeFactoryDependency extends AbstractFactoryDependency {
	/**
	 * PledgeFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PledgeFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PledgeFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new PledgeFactory( Pledge::class, 'pledge', 'pledge_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PledgeFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}