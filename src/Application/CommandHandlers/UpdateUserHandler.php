<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateUserCommand;
use DevPledge\Domain\User;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class UpdateUserHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateUserHandler extends AbstractCommandHandler {
	/**
	 * UpdateUserHandler constructor.
	 */
	public function __construct() {
		parent::__construct( UpdateUserCommand::class );
	}

	/**
	 * @param UpdateUserCommand $command
	 *
	 * @return User
	 * @throws \DevPledge\Application\Factory\FactoryException
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	protected function handle( $command ) {

		$oldUser     = $command->getUser();
		$userService = UserServiceProvider::getService();
		$user        = $userService->getByUserId( $oldUser->getId() );
		$data        = $command->getData();
		$removeArray = [ 'user_id', 'created', 'modified', 'username', 'hashed_password' ];
		foreach ( $data as $key => $value ) {
			if ( in_array( $key, $removeArray ) ) {
				unset( $data->{$key} );
			}
			if ( $value === null ) {
				unset( $data->{$key} );
			}
		}

		if ( ! $user->isPersistedDataFound() ) {
			throw new CommandException( 'Can not update User Object unless updating persisted object' );
		}

		return $userService->update(
			$user, $data
		);
	}
}