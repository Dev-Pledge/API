<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 10/08/2018
 * Time: 10:54
 */

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\ListController;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class ListRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class ListRouteGroup extends AbstractRouteGroup {
	/**
	 * ListRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/list' );
	}

	protected function callableInGroup() {
		$app = $this->getApp();
		$app->get( '/topics', ListController::class . ':getTopics' );
	}
}