<?php


namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\ListController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class ListControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class ListControllerDependency extends AbstractControllerDependency {
	/**
	 * ListControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( ListController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ListController
	 */
	public function __invoke( Container $container ) {
		return new ListController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ListController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}