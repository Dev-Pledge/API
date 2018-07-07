<?php

namespace DevPledge\Integrations\Middleware\JWT;

use DevPledge\Integrations\Middleware\AbstractMiddleware;
use DevPledge\Integrations\Security\JWT\JWT;
use DevPledge\Integrations\Security\JWT\Token;
use DevPledge\Integrations\ServiceProvider\Services\JWTServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;
/**
 * Class Authorise
 * @package DevPledge\Integrations\JWT
 */
class Authorise extends AbstractMiddleware {
	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return Response|static
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function __invoke( Request $request, Response $response, callable $next ) {
		if ( ! $request->hasHeader( 'Authorization' ) ) {
			return $response->withJson( [ 'error' => 'Missing Authorization header' ], 403 );
		}

		$token   = null;
		$headers = $request->getHeader( 'Authorization' );
		try {
			$found = false;
			foreach ( $headers as $h ) {
				if ( mb_strpos( $h, 'Bearer ' ) === 0 ) {
					$accessToken = substr( $h, 7 );
					if ( mb_strlen( $accessToken ) > 0 ) {
						$found = true;
						/**
						 * @var JWT $jwt
						 */
						$jwt   = JWTServiceProvider::getService();
						$token = $jwt->verify( $accessToken );
					}
					break;
				}
			}
			if ( ! $found ) {
				throw new \Exception( 'Missing access token in Authorization header' );
			}
		} catch ( \Exception $e ) {
			return $response->withJson( [ 'error' => $e->getMessage() ], 403 );
		}

		$request = $request->withAttribute( Token::class, $token );

		$response = $next( $request, $response );

		return $response;
	}


}