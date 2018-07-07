<?php

namespace DevPledge\Integrations\Setting;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

class ExtrapolateSettings extends AbstractExtrapolateForContainer {

	/**
	 * @param AbstractContainerCallable $callable
	 *
	 * @return mixed
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddSetting::setting( $callable );
	}
}