<?php

namespace DevPledge\Framework\ControllerDependencies;

use DevPledge\Framework\Controller\Auth\AuthController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use DevPledge\Integrations\ServiceProvider\Services\JWTService;
use Slim\Container;

/**
 * Class AuthControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class AuthControllerDependency extends AbstractControllerDependency {
	/**
	 * AuthControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( AuthController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return AuthController
	 */
	public function __invoke( Container $container ) {
		$jwt = JWTService::getService();

		return new AuthController( $jwt );
	}

	/**
	 * @return AuthController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}