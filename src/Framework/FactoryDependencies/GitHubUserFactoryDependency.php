<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\GitHubUserFactory;
use DevPledge\Domain\GitHubUser;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class GitHubUserFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class GitHubUserFactoryDependency extends AbstractFactoryDependency {
	/**
	 * GitHubUserFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( GitHubUser::class );
	}


	/**
	 * @param Container $container
	 *
	 * @return GitHubUserFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new GitHubUserFactory( GitHubUser::class, 'user', 'user_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return GitHubUserFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}