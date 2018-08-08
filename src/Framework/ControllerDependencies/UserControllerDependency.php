<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\User\UserController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;

use Slim\Container;

/**
 * Class UserUpdateControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class UserControllerDependency extends AbstractControllerDependency {
	public function __construct() {
		parent::__construct( UserController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserController
	 */
	public function __invoke( Container $container ) {
		return new UserController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}