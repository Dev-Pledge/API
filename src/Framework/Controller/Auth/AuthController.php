<?php

namespace DevPledge\Framework\Controller\Auth;


use DevPledge\Application\Service\UserService;
use DevPledge\Domain\PreferredUserAuth\PreferredUserAuthValidationException;
use DevPledge\Domain\PreferredUserAuth\UsernameGitHub;
use DevPledge\Domain\PreferredUserAuth\UsernamePassword;
use DevPledge\Domain\TokenString;
use DevPledge\Framework\ServiceProviders\GitHubServiceProvider;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Security\JWT\JWT;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;
use Slim\Http\Response;
use TomWright\JSON\Exception\JSONEncodeException;


class AuthController {

	/**
	 * @var JWT
	 */
	private $jwt;

	/**
	 * AuthController constructor.
	 *
	 * @param JWT $jwt
	 */
	public function __construct( JWT $jwt ) {
		$this->jwt = $jwt;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function login( Request $request, Response $response ) {
		$data     = $request->getParsedBody();
		$username = $data['username'] ?? null;
		$password = $data['password'] ?? null;

		if ( isset( $username ) && isset( $password ) ) {
			try {
				$user           = UserServiceProvider::getService()->getByUsername( $username );
				$hashedPassword = $user->getHashedPassword();
				if ( ! isset( $hashedPassword ) ) {
					return $response->withJson( [ 'error' => 'Password Authorisation is not acceptable' ], 401 );
				}
				$userAuth = new UsernamePassword( $username, $password, $user->getHashedPassword() );
				try {
					$userAuth->validate();
				} catch ( PreferredUserAuthValidationException $authException ) {
					return $response->withJson( [
						'error' => $authException->getMessage(),
						'field' => $authException->getField()
					], 401 );
				}

				$token = new TokenString( $user, $this->jwt );

				return $response->withJson( [ 'token' => $token->getTokenString() ] );
			} catch ( \TypeError | \Exception $error ) {
				return $response->withJson( [ 'error' => 'User Not Found' ], 401 );
			}
		}

		return $response->withJson( [ 'error' => 'Invalid username or password' ], 401 );

	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function githubLogin( Request $request, Response $response ) {
		$data  = $request->getParsedBody();
		$state = $data['state'] ?? null;
		$code  = $data['code'] ?? null;

		if ( isset( $state ) && isset( $code ) ) {
			try {
				$githubService = GitHubServiceProvider::getService();
				$githubUser    = $githubService->getGitHubUserByCodeState( $code, $state );
				$user          = UserServiceProvider::getService()->getByGitHubId( $githubUser->getGitHubId() );
				$token         = new TokenString( $user, $this->jwt );

				return $response->withJson( [ 'token' => $token->getTokenString() ] );
			} catch ( \TypeError | \Exception $error ) {
				return $response->withJson( [ 'error' => 'User Not Found' ], 401 );
			}
		}

		return $response->withJson( [ 'error' => 'Invalid Github Login' ], 401 );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function refresh( Request $request, Response $response ) {
		/**
		 * @var Token $token
		 */
		$token = $request->getAttribute( Token::class );

		try {
			$newToken = $this->jwt->generate( $token->getData() );
		} catch ( JSONEncodeException $e ) {
			return $response->withJson( [ 'error' => 'Could not generate token' ], 500 );
		}

		return $response->withJson( [ 'token' => $newToken ] );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function outputTokenPayload( Request $request, Response $response ) {
		/**
		 * @var Token $token
		 */
		$token = $request->getAttribute( Token::class );

		return $response->withJson( [ 'payload' => $token->getData() ] );
	}


}