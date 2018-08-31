<?php

namespace DevPledge\Integrations\Extrapolate;

use DevPledge\Integrations\Container\AbstractContainerCallable;

/**
 * Class AbstractExtrapolate
 * @package DevPledge\Integrations\Extrapolator
 */
abstract class AbstractExtrapolateForContainer extends AbstractExtrapolate {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function extrapolate( callable $callable ) {
		$this->add( $callable );
	}

	/**
	 * @param AbstractContainerCallable $callable
	 *
	 * @return mixed
	 */
	abstract protected function add( AbstractContainerCallable $callable );


}