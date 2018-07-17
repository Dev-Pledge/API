<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Problem\ProblemController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class ProblemControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class ProblemControllerDependency extends AbstractControllerDependency {

	public function __construct() {
		parent::__construct( ProblemController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return mixed
	 */
	public function __invoke( Container $container ) {
		return new ProblemController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}