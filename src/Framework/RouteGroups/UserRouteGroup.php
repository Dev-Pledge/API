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
class UserRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/user' );
	}


	protected function callableInGroup() {

		$this->getApp()->get(
			'/profileInfo/{username}',
			UserController::class . ':getProfileInfoByUsername'
		);

		$this->getApp()->post(
			'/createFromEmailPassword',
			UserCreateController::class . ':createUserFromEmailPassword'
		);
		$this->getApp()->post(
			'/createFromGitHub',
			UserCreateController::class . ':createUserFromGitHub'
		);
		$this->getApp()->post(
			'/checkUsernameAvailability',
			UserCreateController::class . ':checkUsernameAvailability'
		);
		$this->getApp()->post(
			'/updatePassword/{user_id}',
			UserUpdateController::class . ':updatePassword'
		)->add( new UserPermission() );

		$this->getApp()->patch(
			'/{user_id}',
			UserUpdateController::class . ':update'
		)->add( new UserPermission() );


	}
}