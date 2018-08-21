<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Auth\PayController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class PayControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class PayControllerDependency extends AbstractControllerDependency {
	/**
	 * PayControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( PayController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PayController
	 */
	public function __invoke( Container $container ) {
		return new PayController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PayController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}