<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class EntityRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class EntityRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/entity' );
	}

	// TODO: Implement __wakeup() met

	protected function callableInGroup() {
		$app = $this->getApp();
		$app->post( '/getForFeed', function ( $request, $response ) {
			$v = $request->getParsedBody();
			var_dump( $v );

		} );
	}
}