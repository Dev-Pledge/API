<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 11/09/2018
 * Time: 10:27
 */

namespace DevPledge\Application\CommandHandlers\CommentHandlers;


use DevPledge\Application\Commands\CommentCommands\CreateReplyCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateReplyHandler
 * @package DevPledge\Application\CommandHandlers\CommentHandlers
 */
class CreateReplyHandler extends AbstractCommandHandler {
	/**
	 * CreateReplyHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateReplyCommand::class );
	}

	/**
	 * @param $command CreateReplyCommand
	 *
	 * @return mixed
	 */
	protected function handle( $command ) {
		$data = new \stdClass();

		$commentService = CommentServiceProvider::getService();

		$parentComment = $commentService->read( $command->getCommentId() );
		if ( $parentComment->isPersistedDataFound() ) {
			$data->parent_comment_id = $parentComment->getId();
			$data->entity_id         = $parentComment->getEntityId();
		} else {
			throw new InvalidArgumentException( 'Parent Comment ' . $command->getCommentId() . ' does not exist!', 'comment_id' );
		}

		$data->user_id = $command->getUser()->getId();
		$organisation  = $command->getOrganisation();
		if ( $organisation ) {
			$data->organisation_id = $organisation->getId();
		}
		if ( isset( $data->organisation_id ) ) {
			CommandPermissionException::tryOrganisationPermission( $command->getUser(), $data->organisation_id, 'create' );
			$data->user_id = null;
		}
		$data->comment = $command->getReplyComment();

		if ( ! strlen( $data->comment ) ) {
			throw new InvalidArgumentException( 'Please give comment longer than 0 characters', 'comment' );
		}

		return $commentService->create(
			$data
		);
	}
}