<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\GitHubService;
use DevPledge\Framework\FactoryDependencies\GitHubUserFactoryDependency;
use DevPledge\Framework\Settings\GitHubSettings;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;

use Slim\Container;

/**
 * Class GitHubServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class GitHubServiceProvider extends AbstractServiceProvider {
	/**
	 * GitHubServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( GitHubService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return GitHubService
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		return new GitHubService( GitHubUserFactoryDependency::getFactory(), GitHubSettings::getSetting(), CacheServiceProvider::getService());
	}

	/**
	 * usually return static::getFromContainer();
	 * @return GitHubService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}