<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\ProblemService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class ProblemServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class ProblemServiceProvider extends AbstractServiceProvider {
	/**
	 * ProblemServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( ProblemService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ProblemService
	 */
	public function __invoke( Container $container ) {
		return new ProblemService();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}