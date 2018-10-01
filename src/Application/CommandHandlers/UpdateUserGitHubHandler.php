<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateUserGitHubCommand;
use DevPledge\Application\Commands\UpdateUserPasswordCommand;
use DevPledge\Domain\PreferredUserAuth\UsernameGitHub;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class UpdateUserPasswordHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateUserGitHubHandler extends AbstractCommandHandler {
	/**
	 * UpdateUserPasswordHandler constructor.
	 */
	public function __construct() {
		parent::__construct( UpdateUserPasswordCommand::class );
	}


	/**
	 * @param $command UpdateUserGitHubCommand
	 *
	 * @return \DevPledge\Domain\User
	 * @throws CommandException
	 * @throws \DevPledge\Application\Factory\FactoryException
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	protected function handle( $command ) {
		$oldUser = $command->getUser();

		$userService = UserServiceProvider::getService();
		$user        = $userService->getByUserId( $oldUser->getId() );
		if ( ! $user->isPersistedDataFound() ) {
			$auth = new UsernameGitHub( $user->getUsername(), $command->getCode(), $command->getState() );
			$auth->validate();
		} else {
			throw new CommandException( 'Has to check against persisted data' );
		}


		return $userService->update(
			$user, (object) $auth->getAuthDataArray()
		);
	}
}