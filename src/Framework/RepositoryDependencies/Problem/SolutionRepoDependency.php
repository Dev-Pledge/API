<?php

namespace DevPledge\Framework\RepositoryDependencies\Problem;


use DevPledge\Application\Repository\SolutionRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\SolutionFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

/**
 * Class SolutionRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies\Problem
 */
class SolutionRepoDependency extends AbstractRepositoryDependency {
	/**
	 * SolutionRepoDependency constructor.
	 */
	public function __construct() {
		parent::__construct( SolutionRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return SolutionRepository
	 */
	public function __invoke( Container $container ) {
		return new SolutionRepository(
			AdapterServiceProvider::getService(),
			SolutionFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return SolutionRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}