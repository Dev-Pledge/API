<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateFollowCommand;
use DevPledge\Application\Commands\DeleteFollowCommand;
use DevPledge\Framework\ServiceProviders\FollowServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class DeleteFollowHandler
 * @package DevPledge\Application\CommandHandlers
 */
class DeleteFollowHandler extends AbstractCommandHandler {
	/**
	 * CreateFollowHandler constructor.
	 */
	public function __construct() {
		parent::__construct( DeleteFollowCommand::class );
	}

	/**
	 * @param $command DeleteFollowCommand
	 *
	 * @return int|null
	 * @throws CommandException
	 */
	protected function handle( $command ) {
		$followService = FollowServiceProvider::getService();
		$userId        = $command->getUser()->getId();
		$entityId      = $command->getEntityId();

		$follow = $followService->readByUserIdEntityId( $userId, $entityId );
		if ( $follow->isPersistedDataFound() ) {

			return $followService->delete( $follow->getId() );
		}
		throw new CommandException( 'Follow Not Found' );

	}
}