<?php

namespace DevPledge\Integrations\Command;


/**
 * Class CommandBus
 * @package DevPledge\Integrations\Command
 */
class CommandBus {

	protected $commandHandlerMap = [];

	/**
	 * @param AbstractCommand $command
	 *
	 * @return mixed
	 * @throws CommandException
	 */
	public function handle( AbstractCommand $command ) {

		$handlerClass = $this->getHandler( get_class( $command ) );
		if ( $handlerClass ) {
			$handler = new $handlerClass();

			return call_user_func_array( $handler, array( $command ) );
		} else {
			throw new CommandException( 'No Command Handler found for ' . get_class( $command ) );
		}
	}

	/**
	 * @param $key
	 *
	 * @return AbstractCommandHandler|null
	 */
	protected function getHandler( $key ): ?AbstractCommandHandler {
		if ( isset( $this->commandHandlerMap[ $key ] ) ) {
			return $this->commandHandlerMap[ $key ];
		}

		return null;
	}

	/**
	 * @param AbstractCommandHandler $commandHandler
	 *
	 * @return $this
	 */
	public function setHandler( AbstractCommandHandler $commandHandler ) {
		$this->commandHandlerMap[ $commandHandler->getContainerKey() ] = $commandHandler;

		return $this;
	}


}