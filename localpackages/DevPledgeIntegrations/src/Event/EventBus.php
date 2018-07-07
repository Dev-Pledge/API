<?php

namespace DevPledge\Integrations\Event;

/**
 * Class EventBus
 * @package DevPledge\Integrations\Event
 */
class EventBus {

	protected $eventHandlerMap = [];

	/**
	 * @param AbstractEvent $event
	 */
	public function handle( AbstractEvent $event ) {

		$handlerClassArray = $this->getHandlers( get_class( $event ) );
		if ( $handlerClassArray ) {
			foreach ( $handlerClassArray as $handlerClass ) {
				$handler = new $handlerClass();
				call_user_func_array( $handler, array( $event ) );
			}
		}
	}

	/**
	 * @param $key
	 *
	 * @return AbstractEventHandler[] | null
	 */
	protected function getHandlers( $key ): ?array {
		if ( isset( $this->eventHandlerMap[ $key ] ) ) {
			return $this->eventHandlerMap[ $key ];
		}

		return null;
	}

	/**
	 * @param AbstractEventHandler $eventHandler
	 *
	 * @return $this
	 */
	public function setHandler( AbstractEventHandler $eventHandler ) {

		if ( ! isset( $this->eventHandlerMap[ $eventHandler->getContainerKey() ] ) ) {
			$this->eventHandlerMap[ $eventHandler->getContainerKey() ] = [];
		}

		$this->eventHandlerMap[ $eventHandler->getContainerKey() ][] = $eventHandler;

		return $this;
	}

}