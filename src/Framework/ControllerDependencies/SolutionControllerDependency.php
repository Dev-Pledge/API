<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Problem\SolutionController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class SolutionControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class SolutionControllerDependency extends AbstractControllerDependency {

	public function __construct() {
		parent::__construct( SolutionController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return mixed
	 */
	public function __invoke( Container $container ) {
		return new SolutionController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}