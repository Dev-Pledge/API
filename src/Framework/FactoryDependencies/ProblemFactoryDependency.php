<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 22:29
 */

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Domain\Problem;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class ProblemFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class ProblemFactoryDependency extends AbstractFactoryDependency {

	public function __construct() {
		parent::__construct( ProblemFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ProblemFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new ProblemFactory( Problem::class, 'problem' ,'problem_id');
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}