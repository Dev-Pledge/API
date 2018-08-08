<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\User\UserController;
use DevPledge\Framework\Controller\User\UserCreateController;
use DevPledge\Framework\Controller\User\UserUpdateController;
use DevPledge\Framework\Middleware\UserPermission;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class UserRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class PublicUserRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/public' );
	}


	protected function callableInGroup() {

		$this->getApp()->get(
			'/user/{username}',
			UserController::class . ':getProfileInfoByUsername'
		);

	}
}