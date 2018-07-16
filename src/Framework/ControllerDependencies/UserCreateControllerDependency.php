<?php

namespace DevPledge\Framework\ControllerDependencies;



use DevPledge\Framework\Controller\User\UserCreateController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use DevPledge\Integrations\ServiceProvider\Services\JWTServiceProvider;
use Slim\Container;

/**
 * Class UserCreateControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class UserCreateControllerDependency extends AbstractControllerDependency {
	public function __construct() {
		parent::__construct( UserCreateController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserCreateController
	 */
	public function __invoke( Container $container ) {
		return new UserCreateController( JWTServiceProvider::getService() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserCreateController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}