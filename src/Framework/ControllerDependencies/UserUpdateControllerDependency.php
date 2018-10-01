<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\User\UserCreateController;
use DevPledge\Framework\Controller\User\UserUpdateController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class UserUpdateControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class UserUpdateControllerDependency extends AbstractControllerDependency {
	public function __construct() {
		parent::__construct( UserUpdateController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return UserCreateController
	 */
	public function __invoke( Container $container ) {
		return new UserUpdateController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return UserCreateController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}