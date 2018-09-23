<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Integrations\Integrations;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use DevPledge\Integrations\Route\AvailableRoutes;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ServerRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class ServerRouteGroup extends AbstractRouteGroup {
	/**
	 * ServerRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/server' );
	}

	protected function callableInGroup() {

		$this->get( '/datetime', function ( Request $request, Response $response ) {
			$now = new \DateTime();

			return $response->withJson( [
				'date'           => $now->format( 'Y-m-d' ),
				'time'           => $now->format( 'H:i:s' ),
				'time_zone'      => $now->getTimezone(),
				'unix_timestamp' => time()
			] );
		} );

		$this->get( '/methods', function ( Request $request, Response $response ) {
			return $response->withJson( AvailableRoutes::get() );
		} );

		$this->get( '/endpoints', function ( Request $request, Response $response ) {
			return $response->withJson( AvailableRoutes::get() );
		} );

		if ( PHP_SAPI == 'cli' ) {
			$this->getApp()->get( '/make/readme', function ( Request $request, Response $response ) {
				$routes = AvailableRoutes::get();
				ob_start();
				echo '# API Endpoints' . PHP_EOL;
				echo '* Header Required: "Content-Type: application/json"' . PHP_EOL . PHP_EOL;
				foreach ( $routes as $route ) {

					echo '* [' . $route->getType() . ' *' . $route->getFullPattern() . '* ](#' . md5( $route->getFullPattern() ) . ')  ' . PHP_EOL;

				}

				foreach ( $routes as $route ) {
					$data = $route->jsonSerialize();
					echo '## <a name="' . md5( $route->getFullPattern() ) . '"></a>' . $route->getType() . ' ' . $route->getFullPattern() . PHP_EOL;
					if ( is_array( $data['requirements'] ) ) {
						echo '### Requirements' . PHP_EOL;
						foreach ( $data['requirements'] as $req ) {
							echo '* ' . $req . PHP_EOL;
						}
					}
					if ( $route->getType() != 'GET' ) {
						echo '#### Example Request' . PHP_EOL;
						echo '```' . PHP_EOL . \json_encode( $route->getRequest()(), JSON_PRETTY_PRINT ) . PHP_EOL . '```' . PHP_EOL;
					}
					echo '#### Example Response' . PHP_EOL;
					echo '```' . PHP_EOL . \json_encode( $route->getResponse()(), JSON_PRETTY_PRINT ) . PHP_EOL . '```' . PHP_EOL . PHP_EOL;

				}
				$doc = ob_get_clean();

				if ( file_put_contents( Integrations::getBaseDir() . '/ENDPOINTS.MD', $doc ) ) {
					return $response->withJson( [ 'ENDPOINTS.MD' => 'built' ] );
				}

				return $response->withJson( [ 'ENDPOINTS.MD' => 'failed' ] );

			} );
		}
	}
}