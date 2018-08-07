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

			return $problemService->update( $problem, $command->getData() );
		}

		throw new InvalidArgumentException( 'Problem ID does not match a current Problem' );

	}
}