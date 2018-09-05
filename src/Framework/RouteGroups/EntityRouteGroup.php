<?php

namespace DevPledge\Framework\RouteGroups;

use DevPledge\Framework\Controller\EntityController;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class EntityRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class EntityRouteGroup extends AbstractRouteGroup {
	/**
	 * EntityRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/entity' );
	}

	protected function callableInGroup() {
		$app = $this->getApp();
		$app->post( '/getForFeed', EntityController::class . ':getFeedEntities' );
	}
}