<?php


namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Pledge\PledgeController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class PledgeControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class PledgeControllerDependency extends AbstractControllerDependency {
	/**
	 * PledgeControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PledgeController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PledgeController
	 */
	public function __invoke( Container $container ) {
		return new PledgeController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PledgeController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}