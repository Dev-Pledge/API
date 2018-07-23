<?php


namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\UpdateProblemCommand;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class UpdateProblemHandler
 * @package DevPledge\Application\CommandHandlers
 */
class UpdateProblemHandler extends AbstractCommandHandler {
	/**
	 * @param $command UpdateProblemCommand
	 *
	 * @return \DevPledge\Domain\Problem
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	protected function handle( $command ) {



		$problemService = ProblemServiceProvider::getService();

		$problem = $problemService->read( $command->getProblemId() );

		if($problem)

		return $problemService->update( $problem, $command->getData() );
	}
}