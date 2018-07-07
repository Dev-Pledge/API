<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateUserCommand;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateUserHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateUserHandler extends AbstractCommandHandler {

	public function __construct() {
		parent::__construct( CreateUserCommand::class );
	}

	/**
	 * @param $command
	 *
	 * @return string
	 * @throws \Exception
	 */
	protected function handle( $command ) {
		$auth = $command->getPreferredUserAuth();
		$auth->validate();

		return UserServiceProvider::getService()->create(
			$auth
		);

	}
}