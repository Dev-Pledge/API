<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\OrganisationController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;


/**
 * Class OrganisationRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class OrganisationRouteGroup extends AbstractRouteGroup {
	/**
	 * OrganisationRouteGroup constructor.
	 * @throws \DevPledge\Integrations\Route\Exception
	 */
	public function __construct() {
		parent::__construct( '/organisation', [ new Authorise ] );

	}

	protected function callableInGroup() {
		$this->get( '/{id}', OrganisationController::class . ':getOrganisation' );
	}
}