<?php

namespace DevPledge\Integrations\RepositoryDependency;


use DevPledge\Integrations\Container\AbstractContainerCallable;

/**
 * Class AbstractRepositoryDependency
 * @package DevPledge\Integrations\RepositoryDependency
 */
abstract class AbstractRepositoryDependency extends AbstractContainerCallable {
	/**
	 * usually return static::getFromContainer();
	 * @return mixed
	 */
	abstract static public function getRepository();
}