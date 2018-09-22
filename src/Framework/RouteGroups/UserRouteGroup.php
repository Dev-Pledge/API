<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Auth\PayController;
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

		$this->post(
			'/createFromEmailPassword',
			UserCreateController::class . ':createUserFromEmailPassword'
		);
		$this->post(
			'/createFromGitHub',
			UserCreateController::class . ':createUserFromGitHub'
		);
		$this->post(
			'/checkUsernameAvailability',
			UserCreateController::class . ':checkUsernameAvailability'
		);
		$this->post(
			'/updatePassword/{user_id}',
			UserUpdateController::class . ':updatePassword'
		)->add( new UserPermission() );

		$this->patch(
			'/{user_id}',
			UserUpdateController::class . ':update'
		)->add( new UserPermission() );

		$this->post(
			'createStripePaymentMethod/{user_id}',
			PayController::class . ':createUserStripePaymentMethod'
		)->add( new UserPermission() );

		$this->get(
			'paymentMethods/{user_id}',
			PayController::class . ':getUserPaymentMethods'
		)->add( new UserPermission() );


	}
}