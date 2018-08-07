<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateUserPasswordCommand;
use DevPledge\Domain\PreferredUserAuth\UsernamePassword;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class UpdateUserPasswordHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateUserPasswordHandler extends AbstractCommandHandler {
	/**
	 * UpdateUserPasswordHandler constructor.
	 */
	public function __construct() {
		parent::__construct( UpdateUserPasswordCommand::class );
	}


	/**
	 * @param $command UpdateUserPasswordCommand
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
			$auth = new UsernamePassword( $user->getUsername(), $command->getOldPassword(), $user->getHashedPassword() );
		} else {
			throw new CommandException( 'Has to check against persisted data' );
		}
		$auth->validate();
		$newAuth = new UsernamePassword( $user->getUsername(), $command->getNewPassword() );

		return $userService->update(
			$command->getUser(), (object) $newAuth->getAuthDataArray()
		);
	}
}