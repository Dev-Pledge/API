<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 27/09/2018
 * Time: 14:33
 */

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Middleware\OriginPermission;
use DevPledge\Framework\Settings\GitHubSettings;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use Slim\Http\Request;
use Slim\Http\Response;

class OauthRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/oauth', [ new OriginPermission() ] );
	}

	protected function callableInGroup() {
		$github = function () {
			return (object) [ 'url' => GitHubSettings::getSetting()->getAuthoriseUrl( 'aSt2taateYouGeenerAtEd00' ) ];
		};

		$this->get( '/github/auth/url/{state}',
			function ( Request $request, Response $response ) {
				$state = $request->getAttribute( 'state' );
				return $response->withJson( [ 'url' => GitHubSettings::getSetting()->getAuthoriseUrl( $state ) ] );
			}
			, $github );
	}
}