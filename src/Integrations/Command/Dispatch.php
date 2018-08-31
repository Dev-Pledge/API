<?php


namespace DevPledge\Integrations\Command;


use DevPledge\Integrations\Event\AbstractEvent;
use DevPledge\Integrations\ServiceProvider\Services\CommandBusServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\EventBusServiceProvider;

/**
 * Class Dispatch
 * @package DevPledge\Integrations\Command
 */
class Dispatch {
	/**
	 * @param AbstractCommand $command
	 *
	 * @return mixed
	 * @throws CommandException
	 */
	static public function command( AbstractCommand $command ) {
		return CommandBusServiceProvider::getService()->handle( $command );
	}

	/**
	 * @param AbstractEvent $event
	 */
	static public function event( AbstractEvent $event ) {
		EventBusServiceProvider::getService()->handle( $event );
	}

}