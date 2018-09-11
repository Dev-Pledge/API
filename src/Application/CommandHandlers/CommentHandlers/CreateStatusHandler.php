<?php

namespace DevPledge\Application\CommandHandlers\CommentHandlers;


use DevPledge\Application\Commands\CommentCommands\CreateStatusCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateCommentHandler
 * @package DevPledge\Application\CommandHandlers\CommentHandlers
 */
class CreateStatusHandler extends AbstractCommandHandler {
	/**
	 * CreateCommentHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateStatusCommand::class );
	}

	/**
	 * @param $command CreateStatusCommand
	 *
	 * @return \DevPledge\Domain\Comment
	 * @throws CommandPermissionException
	 */
	protected function handle( $command ) {
		$data          = $command->getData();
		$data->user_id = $command->getUser()->getId();
		$organisation  = $command->getOrganisation();
		if ( $organisation ) {
			$data->organisation_id = $organisation->getId();
		}
		if ( isset( $data->organisation_id ) ) {
			CommandPermissionException::tryOrganisationPermission( $command->getUser(), $data->organisation_id, 'create' );
			$data->user_id = null;
		}

		if ( ! (isset($data->comment) && strlen( $data->comment ) )) {
			throw new InvalidArgumentException( 'Please give comment longer than 0 characters', 'comment' );
		}

		if ( ! ( isset( $data->topics ) && is_array( $data->topics ) && count( $data->topics ) ) ) {
			throw new InvalidArgumentException( 'At least one topic is required', 'topics' );
		}

		/**
		 * NO entity id is required as it will auto generate to be the comment id by default!
		 */
		return CommentServiceProvider::getService()->create(
			$data
		);
	}
}