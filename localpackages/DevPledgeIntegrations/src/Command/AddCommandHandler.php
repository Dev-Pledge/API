<?php

namespace DevPledge\Integrations\Command;

use DevPledge\Integrations\Container\AddCallable;
use DevPledge\Integrations\ServiceProvider\Services\CommandBusServiceProvider;

/**
 * Class AddRepositoryDependency
 * @package DevPledge\Integrations\RepositoryDependency
 */
class AddCommandHandler extends AddCallable {
	/**
	 * @param AbstractCommandHandler $commandHandler
	 *
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public static function commandHandler( AbstractCommandHandler $commandHandler ) {
		$commandBusService = CommandBusServiceProvider::getService();

		$commandBusService->setHandler( $commandHandler );

	}

	/**
	 * @param AbstractCommandHandler $commandHandler
	 *
	 * @return $this
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function addCommandHandler( AbstractCommandHandler $commandHandler ) {
		static::commandHandler( $commandHandler );

		return $this;
	}
}