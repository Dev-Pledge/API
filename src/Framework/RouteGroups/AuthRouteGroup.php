<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\Role\Member;
use DevPledge\Domain\TokenString;
use DevPledge\Domain\User;
use DevPledge\Framework\Controller\Auth\AuthController;
use DevPledge\Framework\Middleware\OriginPermission;
use DevPledge\Integrations\Integrations;
use DevPledge\Integrations\Middleware\JWT\Present;
use DevPledge\Integrations\Middleware\JWT\Refresh;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use DevPledge\Integrations\Security\JWT\Token;
use DevPledge\Integrations\ServiceProvider\Services\JWTServiceProvider;

/**
 * Class AuthRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class AuthRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/auth' );
	}

	protected function callableInGroup() {
		$tokenExample   = function () {
			$token = new TokenString( User::getExampleInstance(), JWTServiceProvider::getService() );

			return (object) [ 'token' => $token->getTokenString() ];
		};
		$payloadExample = function () {
			$obj       = new \stdClass();
			$perms     = new Member();
			$obj->data = (object) [ 'permissions' => $perms->getDefaultPermissions()->toAPIMapArray() ];
			$token     = new Token( $obj );

			return (object) [ 'payload' => $token->getData() ];
		};

		$this->post( '/login', AuthController::class . ':login',
			function () {
				return (object) [ 'username' => 'CoolGuy121', 'password' => 'myextremelySAFEpassword!z**' ];
			},
			$tokenExample,
			new OriginPermission()
		);

		$this->post( '/githubLogin', AuthController::class . ':githubLogin',
			function () {
				return (object) [ 'code' => '987ygnedjdmdlajhda', 'state' => 'nd98ydahedkjabsdkjb' ];
			},
			$tokenExample,
			new OriginPermission()
		);

		$this->post( '/refresh', AuthController::class . ':refresh',
			function () {
				return new \stdClass();
			},
			$tokenExample,
			new Refresh()
		);

		$this->get( '/payload', AuthController::class . ':outputTokenPayload', $payloadExample, new Present() );
	}


}