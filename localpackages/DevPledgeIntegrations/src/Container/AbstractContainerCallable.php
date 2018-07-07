<?php

namespace DevPledge\Integrations\Container;

use Slim\Container;

/**
 * Class AbstractContainerCallable
 * @package DevPledge\Integrations\Container
 */
abstract class AbstractContainerCallable extends AbstractContainerKey {

	/**
	 * @param Container $container
	 *
	 * @return mixed
	 */
	abstract public function __invoke( Container $container );


}