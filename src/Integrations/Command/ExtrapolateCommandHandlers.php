<?php

namespace DevPledge\Integrations\Command;

use DevPledge\Integrations\Extrapolate\AbstractExtrapolate;


/**
 * Class ExtrapolateCommandHandlers
 * @package DevPledge\Integrations\Command
 */
class ExtrapolateCommandHandlers extends AbstractExtrapolate {
	/**
	 * @param AbstractCommandHandler $commandHandler
	 *
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	protected function add( AbstractCommandHandler $commandHandler ) {
		AddCommandHandler::commandHandler( $commandHandler );
	}

	protected function extrapolate( callable $callable ) {
		$this->add( $callable );
	}

}