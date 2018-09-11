<?php

namespace DevPledge\Framework\RepositoryDependencies\Problem;


use DevPledge\Application\Repository\TopicsProblemRepository;
use DevPledge\Framework\FactoryDependencies\ProblemFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class TopicsProblemRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies
 */
class TopicsProblemRepoDependency extends AbstractRepositoryDependency {
	/**
	 * TopicsProblemRepoDependency constructor.
	 */
	public function __construct() {
		parent::__construct( TopicsProblemRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return TopicsProblemRepository
	 */
	public function __invoke( Container $container ) {

		return new TopicsProblemRepository(
			AdapterServiceProvider::getService(),
			ProblemFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return TopicsProblemRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}