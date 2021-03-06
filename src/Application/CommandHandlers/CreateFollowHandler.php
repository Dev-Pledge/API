<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateFollowCommand;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\EntityServiceProvider;
use DevPledge\Framework\ServiceProviders\FollowServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateFollowHandler
 * @package DevPledge\Application\CommandHandlers
 */
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
		 * this will throw InvalidArgument Exception
		 */
		EntityServiceProvider::getService()->read( $entityId );

		return $followService->create( (object) [ 'user_id' => $userId, 'entity_id' => $entityId ] );
	}
}