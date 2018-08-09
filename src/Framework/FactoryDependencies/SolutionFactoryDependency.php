<?php


namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\SolutionFactory;
use DevPledge\Domain\Solution;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class SolutionFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class SolutionFactoryDependency extends AbstractFactoryDependency {
	public function __construct() {
		parent::__construct( SolutionFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return SolutionFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new SolutionFactory( Solution::class, 'solution', 'solution_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return SolutionFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}