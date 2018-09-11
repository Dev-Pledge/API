<?php

namespace DevPledge\Application\CommandHandlers\CommentHandlers;


use DevPledge\Application\Commands\CommentCommands\CreateCommentCommand;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Framework\ServiceProviders\EntityServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateCommentHandler
 * @package DevPledge\Application\CommandHandlers\CommentHandlers
 */
class CreateCommentHandler extends AbstractCommandHandler {
	/**
	 * CreateCommentHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateCommentCommand::class );
	}

	/**
	 * @param $command CreateCommentCommand
	 *
	 * @return \DevPledge\Domain\Comment
	 * @throws CommandPermissionException
	 */
	protected function handle( $command ) {
		$data            = new \stdClass();
		$data->entity_id = $command->getEntityId();
		$data->user_id   = $command->getUser()->getId();
		$data->comment   = $command->getComment();
		$organisation    = $command->getOrganisation();
		if ( $organisation ) {
			$data->organisation_id = $organisation->getId();
		}

		$entity = EntityServiceProvider::getService()->read( $data->entity_id );

		if ( ! ( ( $entity instanceof AbstractDomain ) && $entity->isPersistedDataFound() ) ) {
			throw new InvalidArgumentException( 'Entity Does not exist!', 'entity_id' );
		}

		if ( isset( $data->organisation_id ) ) {
			CommandPermissionException::tryOrganisationPermission( $command->getUser(), $data->organisation_id, 'create' );
			$data->user_id = null;
		}
		$data->comment = $command->getComment();

		if ( ! strlen( $data->comment ) ) {
			throw new InvalidArgumentException( 'Please give comment longer than 0 characters', 'comment' );
		}

		return CommentServiceProvider::getService()->create(
			$data
		);
	}
}