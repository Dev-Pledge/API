<?php

namespace DevPledge\Framework\RouteGroups;


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
	}
}