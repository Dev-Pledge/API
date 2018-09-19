<?php

namespace DevPledge\Application\EventHandlers;

use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Integrations\Event\AbstractEventHandler;
use DevPledge\Integrations\Sentry;

/**
 * Class TestHandler
 * @package DevPledge\Application\EventHandlers
 */
class TestHandler extends AbstractEventHandler {
	public function __construct() {
		parent::__construct( CreatedDomainEvent::class );
	}

	/**
	 * @param $event CreatedDomainEvent
	 */
	protected function handle( $event ) {
		Sentry::get()->message( $event->getDomain()->getUuid()->getEntity() );
	}
}