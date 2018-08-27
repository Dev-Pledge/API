<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\FeedService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class FeedServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class FeedServiceProvider extends AbstractServiceProvider {
	/**
	 * FeedServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( FeedService::class);
	}

	/**
	 * @param Container $container
	 *
	 * @return FeedService
	 */
	public function __invoke( Container $container ) {
		return new FeedService();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return FeedService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}