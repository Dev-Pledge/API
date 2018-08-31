<?php

namespace DevPledge\Integrations\ControllerDependency;

use DevPledge\Integrations\Container\AbstractContainerCallable;

/**
 * Class AbstractControllerDependency
 * @package DevPledge\Integrations\ControllerDependency
 */
abstract class AbstractControllerDependency extends AbstractContainerCallable {
	/**
	 * usually return static::getFromContainer();
	 * @return mixed
	 */
	abstract static public function getController();
}