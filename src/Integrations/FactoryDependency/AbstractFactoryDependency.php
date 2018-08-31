<?php

namespace DevPledge\Integrations\FactoryDependency;


use DevPledge\Integrations\Container\AbstractContainerCallable;

/**
 * Class AbstractFactoryDependency
 * @package DevPledge\Integrations\FactoryDependency
 */
abstract class AbstractFactoryDependency extends AbstractContainerCallable {
	/**
	 * usually return static::getFromContainer();
	 * @return mixed
	 */
	abstract static public function getFactory();
}