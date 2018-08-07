<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateUserCommand;
use DevPledge\Domain\User;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

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
		$data        = $command->getData();
		$removeArray = [ 'user_id', 'created', 'modified', 'username' ];
		foreach ( $data as $key => $value ) {
			if ( in_array( $key, $removeArray ) ) {
				unset( $data->{$key} );
			}
		}

		return UserServiceProvider::getService()->update(
			$command->getUser(), $data
		);
	}
}