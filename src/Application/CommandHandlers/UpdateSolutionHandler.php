<?php


namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateSolutionCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\SolutionServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class UpdateSolutionHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateSolutionHandler extends AbstractCommandHandler {
	/**
	 * UpdatesolutionHandler constructor.
	 */
	public function __construct() {
		parent::__construct( UpdateSolutionCommand::class );
	}


	/**
	 * @param $command UpdateSolutionCommand
	 *
	 * @return \DevPledge\Domain\solution
	 * @throws CommandPermissionException
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	protected function handle( $command ) {


		$solutionService = SolutionServiceProvider::getService();

		$solution = $solutionService->read( $command->getsolutionId() );

		if ( $solution ) {
			CommandPermissionException::tryException( $solution, $command->getUser(), 'write' );

			return $solutionService->update( $solution, $command->getData() );
		}

		throw new InvalidArgumentException( 'solution ID does not match a current solution' );

	}
}