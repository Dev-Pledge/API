<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Application\Commands\AuthoriseUserCommand;
use DevPledge\Application\Commands\UpdateUserCommand;
use DevPledge\Application\Commands\UpdateUserGitHubCommand;
use DevPledge\Application\Commands\UpdateUserPasswordCommand;
use DevPledge\Domain\TokenString;
use DevPledge\Domain\User;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Integrations\Command\Dispatch;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UserUpdateController
 * @package DevPledge\Framework\Controller\User
 */
class UserUpdateController extends AbstractController {


	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 * @throws \TomWright\JSON\Exception\JSONEncodeException
	 */
	public function update( Request $request, Response $response ) {
		$data = $request->getParsedBody();

		try {
			/**
			 * @var $user User
			 */
			$user = Dispatch::command( new UpdateUserCommand( $this->getUserFromRequest( $request ), (object) $data ) );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'unable to update user' ], 401 );
		}

		if ( ( $user instanceof User ) && $user->isPersistedDataFound() ) {
			$token = $this->getTokenString( $user );

			return $response->withJson(
				[
					'user_id'      => $user->getId(),
					'username'     => $user->getUsername(),
					'updated_user' => $user->toAPIMap(),
					'token'        => $token->getTokenString()
				]
			);
		}

		return $response->withJson(
			[ 'error' => 'failed' ]
			, 401
		);
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 * @throws \TomWright\JSON\Exception\JSONEncodeException
	 */
	public function updatePassword( Request $request, Response $response ) {
		$data        = $request->getParsedBody();
		$oldPassword = $data['old_password'] ?? null;
		$newPassword = $data['new_password'] ?? null;
		if ( is_null( $oldPassword ) ) {
			return $response->withJson( [ 'error' => 'unable to update user', 'field' => 'old_password' ], 401 );
		}
		if ( is_null( $newPassword ) ) {
			return $response->withJson( [ 'error' => 'unable to update user', 'field' => 'new_password' ], 401 );
		}
		try {
			/**
			 * @var $user User
			 */
			$user = Dispatch::command(
				new UpdateUserPasswordCommand( $this->getUserFromRequest( $request ), $oldPassword, $newPassword )
			);
		} catch ( \Exception  | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'unable to update user password' ], 401 );
		}

		if ( ( $user instanceof User ) && $user->isPersistedDataFound() ) {
			$token = $this->getTokenString( $user );

			return $response->withJson(
				[
					'user_id'      => $user->getId(),
					'username'     => $user->getUsername(),
					'updated_user' => $user->toAPIMap(),
					'token'        => $token->getTokenString()
				]
			);
		}

		return $response->withJson(
			[ 'error' => 'failed' ]
			, 401
		);
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 * @throws \TomWright\JSON\Exception\JSONEncodeException
	 */
	public function updateGithub( Request $request, Response $response ) {
		$data  = $request->getParsedBody();
		$code  = $data['code'] ?? null;
		$state = $data['state'] ?? null;

		try {
			/**
			 * @var $user User
			 */
			$user = Dispatch::command(
				new UpdateUserGitHubCommand( $this->getUserFromRequest( $request ), $code, $state )
			);
		} catch ( \Exception  | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'unable to update user GitHub ID' ], 401 );
		}

		if ( ( $user instanceof User ) && $user->isPersistedDataFound() ) {
			$token = $this->getTokenString( $user );

			return $response->withJson(
				[
					'user_id'      => $user->getId(),
					'username'     => $user->getUsername(),
					'updated_user' => $user->toAPIMap(),
					'token'        => $token->getTokenString()
				]
			);
		}

		return $response->withJson(
			[ 'error' => 'failed' ]
			, 401
		);
	}

	/**
	 * @param User $user
	 *
	 * @return TokenString
	 * @throws \DevPledge\Integrations\Command\CommandException
	 */
	protected function getTokenString( User $user ): TokenString {
		return Dispatch::command( new AuthoriseUserCommand( $user, 'update' ) );
	}
}