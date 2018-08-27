<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 27/08/2018
 * Time: 15:34
 */

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\FollowController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class FollowControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class FollowControllerDependency extends AbstractControllerDependency {
	/**
	 * FollowControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( FollowController::class);
	}

	/**
	 * @param Container $container
	 *
	 * @return FollowController
	 */
	public function __invoke( Container $container ) {
		return new FollowController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return FollowController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}