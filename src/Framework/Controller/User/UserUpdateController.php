<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Application\Commands\UpdateUserCommand;
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
	 * @var JWT
	 */
	private $jwt;

	/**
	 * UserCreateController constructor.
	 *
	 * @param JWT $jwt
	 */
	public function __construct( JWT $jwt ) {
		$this->jwt = $jwt;
	}

	public function update( Request $request, Response $response ) {
		$data = $request->getParsedBody();
		try {
			/**
			 * @var $user User
			 */
			$user = Dispatch::command( new UpdateUserCommand( $this->getUserFromRequest( $request ), (object) $data ) );
		} catch ( \Exception $exception ) {
			return $response->withJson( [ 'error' => 'unable to update user' ], 401 );
		}

		if ( ( $user instanceof User ) && $user->isPersistedDataFound() ) {
			$token = new TokenString( $user, $this->jwt );

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
}