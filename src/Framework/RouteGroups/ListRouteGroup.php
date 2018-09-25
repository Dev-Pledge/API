<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 10/08/2018
 * Time: 10:54
 */

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\Topics;
use DevPledge\Framework\Controller\ListController;
use DevPledge\Framework\ServiceProviders\TopicServiceProvider;
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

		$this->get( '/topics', ListController::class . ':getTopics', function () {
			return (object) [
				'topics' => ( new Topics( TopicServiceProvider::getService()->getTopics() ) )->toAPIMapArray()
			];
		} );
	}
}