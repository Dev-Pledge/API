<?php

namespace DevPledge\Framework\Middleware;


use DevPledge\Integrations\Middleware\AbstractMiddleware;
use DevPledge\Integrations\Route\MiddleWareAuthRequirement;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class OriginPermission
 * @package DevPledge\Framework\Middleware
 */
class OriginPermission extends AbstractMiddleware implements MiddleWareAuthRequirement {

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return mixed
	 */
	public function __invoke( Request $request, Response $response, callable $next ) {

		$token   = null;
		$headers = $request->getHeader( 'Origin-Auth' );
		try {
			$found = false;
			if ( getenv( 'ENVIRONMENT' ) == 'development' ) {
				$found = true;
			}
			foreach ( $headers as $h ) {

				/**
				 * ONLY SERVERS THAT HAVE ACCESS TO OUR REDIS SERVER WILL BE ABLE TO GET THIS TOKEN
				 */
				$originToken = CacheServiceProvider::getService()->get( 'originToken' );
				if ( trim( $h ) == $originToken ) {
					$found = true;
				}

				break;

			}
			if ( ! $found ) {
				throw new \Exception( 'Missing Origin-Auth header' );
			}
		} catch ( \Exception $e ) {
			return $response->withJson( [ 'error' => $e->getMessage() ], 403 );
		}


		$response = $next( $request, $response );

		return $response;
	}

	public function getAuthRequirement(): ?array {
		return [
			'Header Required: "Origin-Auth: {origin_token}"'
		];
	}
}