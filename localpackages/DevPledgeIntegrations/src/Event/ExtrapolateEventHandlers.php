<?php

namespace DevPledge\Integrations\Event;

use DevPledge\Integrations\Extrapolate\AbstractExtrapolate;

/**
 * Class ExtrapolateEventHandlers
 * @package DevPledge\Integrations\Event
 */
class ExtrapolateEventHandlers extends AbstractExtrapolate {
	/**
	 * @param AbstractEventHandler $eventHandler
	 */
	protected function add( AbstractEventHandler $eventHandler ) {
		AddEventHandler::eventHandler( $eventHandler );
	}

	protected function extrapolate( callable $callable ) {
		$this->add( $callable );
	}
}