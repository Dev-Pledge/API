<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateFollowCommand;
use DevPledge\Framework\ServiceProviders\FollowServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

class CreateFollowHandler extends AbstractCommandHandler {
	/**
	 * CreateFollowHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateFollowCommand::class );
	}

	/**
	 * @param $command CreateFollowCommand
	 *
	 * @return \DevPledge\Domain\Follow
	 * @throws \Exception
	 */
	protected function handle( $command ) {
		$followService = FollowServiceProvider::getService();
		$userId        = $command->getUser()->getId();
		$entityId      = $command->getEntityId();

		/**
		 * check on universal entity
		 */
		return $followService->create( (object) [ 'user_id' => $userId, 'entity_id' => $entityId ] );
	}
}