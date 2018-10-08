<?php


namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateProblemCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class UpdateProblemHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateProblemHandler extends AbstractCommandHandler {
	/**
	 * UpdateProblemHandler constructor.
	 */
	public function __construct() {
		parent::__construct( UpdateProblemCommand::class );
	}


	/**
	 * @param $command UpdateProblemCommand
	 *
	 * @return \DevPledge\Domain\Problem
	 * @throws CommandPermissionException
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	protected function handle( $command ) {


		$problemService = ProblemServiceProvider::getService();

		$problem = $problemService->read( $command->getProblemId() );

		if ( $problem ) {
			CommandPermissionException::tryException( $problem, $command->getUser(), 'write' );
			$data = $command->getData();
			if ( isset( $data->make_active ) && $data->make_active == true &&
			     ! ( isset( $data->active_datetime ) && is_string( $data->active_datetime ) )
			) {
				$data->active_datetime = ( new \DateTime( 'now' ) )->format( 'Y-m-d H:i:s' );
			}

			return $problemService->update( $problem, $data );
		}

		throw new InvalidArgumentException( 'Problem ID does not match a current Problem' );

	}
}