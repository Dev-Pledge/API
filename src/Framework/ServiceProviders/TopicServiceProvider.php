<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\TopicService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

class TopicServiceProvider extends AbstractServiceProvider {

	/**
	 * @param Container $container
	 *
	 * @return TopicService
	 */
	public function __invoke( Container $container ) {
		return new TopicService();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return TopicService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}