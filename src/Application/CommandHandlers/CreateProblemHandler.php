<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 23:25
 */

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateProblemCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateProblemHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateProblemHandler extends AbstractCommandHandler {
	/**
	 * CreateProblemHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateProblemCommand::class );
	}

	/**
	 * @param $command CreateProblemCommand
	 *
	 * @throws \Exception
	 * @return \DevPledge\Domain\Problem
	 */
	protected function handle( $command ) {

		$data          = $command->getData();
		$data->user_id = $command->getUser()->getId();
		$validateArray = [ 'title', 'description' ];
		foreach ( $validateArray as $validate ) {
			if ( ! ( isset( $data->{$validate} ) && strlen( $data->{$validate} ) > 3 ) ) {
				throw new InvalidArgumentException( $validate . ' does not have required information', $validate );
			}
		}

		if ( ! ( isset( $data->topics ) && is_array( $data->topics ) && count( $data->topics ) ) ) {
			throw new InvalidArgumentException( 'At least one topic is required', 'topics' );
		}

		if ( isset( $data->organisation_id ) ) {
			CommandPermissionException::tryOrganisationPermission( $command->getUser(), $data->organisation_id, 'create' );
			$data->user_id = null;
		}

		if ( isset( $data->make_active ) && $data->make_active == true &&
		     ! ( isset( $data->active_datetime ) && is_string( $data->active_datetime ) )
		) {
			$data->active_datetime = ( new \DateTime( 'now' ) )->format( 'Y-m-d H:i:s' );
		}

		return ProblemServiceProvider::getService()->create(
			$data
		);

	}
}