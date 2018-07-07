<?php

namespace DevPledge\Integrations\Event;


use DevPledge\Integrations\Container\AbstractContainerKey;

/**
 * Class AbstractEventHandler
 * @package DevPledge\Integrations\Event
 */
abstract class AbstractEventHandler extends AbstractContainerKey {
	/**
	 * Use Command DoneRandomThingCommand::class
	 * AbstractEventHandler constructor.
	 *
	 * @param string $event
	 */
	public function __construct( string $event ) {
		parent::__construct( $event );
	}

	/**
	 * @param AbstractEvent $event
	 *
	 * @return mixed
	 */
	public function __invoke( AbstractEvent $event ) {
		return $this->handle( $event );
	}


	abstract protected function handle( $event );

}