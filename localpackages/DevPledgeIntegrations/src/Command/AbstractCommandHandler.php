<?php

namespace DevPledge\Integrations\Command;


use DevPledge\Integrations\Container\AbstractContainerKey;


/**
 * Class AbstractCommandHandler
 * @package DevPledge\Integrations\Command
 */
abstract class AbstractCommandHandler extends AbstractContainerKey {
	/**
	 * Use Command DoRandomThingCommand::class
	 * AbstractCommandHandler constructor.
	 *
	 * @param string $command
	 */
	public function __construct( string $command ) {
		parent::__construct( $command );
	}

	/**
	 * @param AbstractCommand $command
	 *
	 * @return mixed
	 */
	public function __invoke( AbstractCommand $command ) {
		return $this->handle( $command );
	}

	abstract protected function handle( $command );


}