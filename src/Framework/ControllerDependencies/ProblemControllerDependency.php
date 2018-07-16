<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 23:12
 */

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\User\ProblemController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class ProblemControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class ProblemControllerDependency extends AbstractControllerDependency {

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