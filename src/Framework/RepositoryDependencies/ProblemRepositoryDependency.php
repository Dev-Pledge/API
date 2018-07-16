<?php

namespace DevPledge\Framework\RepositoryDependencies;


use DevPledge\Application\Repository\ProblemRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\ProblemFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class ProblemRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies
 */
class ProblemRepositoryDependency extends AbstractRepositoryDependency {

	public function __construct() {
		parent::__construct( ProblemRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ProblemRepository
	 */
	public function __invoke( Container $container ) {
		$factory = ProblemFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );

		return new ProblemRepository( $adaptor, $factory );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}