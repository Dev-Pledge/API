<?php


namespace DevPledge\Integrations\Event;


use DevPledge\Integrations\Container\AddCallable;
use DevPledge\Integrations\ServiceProvider\Services\EventBusServiceProvider;

/**
 * Class AddEventHandler
 * @package DevPledge\Integrations\Event
 */
class AddEventHandler extends AddCallable {
	/**
	 * @param AbstractEventHandler $eventHandler
	 */
	public static function eventHandler( AbstractEventHandler $eventHandler ) {
		$eventBusService = EventBusServiceProvider::getService();

		$eventBusService->setHandler( $eventHandler );

	}

	/**
	 * @param AbstractEventHandler $eventHandler
	 *
	 * @return $this
	 */
	public function addEventHandler( AbstractEventHandler $eventHandler ) {
		static::eventHandler( $eventHandler );

		return $this;
	}

}