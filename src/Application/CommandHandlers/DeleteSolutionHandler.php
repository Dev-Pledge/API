<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 14/08/2018
 * Time: 15:17
 */

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\DeleteSolutionCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\SolutionServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class DeleteSolutionHandler
 * @package DevPledge\Application\CommandHandlers
 */
class DeleteSolutionHandler extends AbstractCommandHandler {
	/**
	 * DeleteSolutionHandler constructor.
	 */
	public function __construct() {
		parent::__construct( DeleteSolutionCommand::class );
	}


	/**
	 * @param $command DeleteSolutionCommand
	 *
	 * @throws CommandPermissionException
	 */
	protected function handle( $command ) {


		$solutionService = SolutionServiceProvider::getService();

		$solution = $solutionService->read( $command->getSolutionId() );
		if ( $solution ) {
			CommandPermissionException::tryException( $solution, $command->getUser(), 'delete' );
		}
		throw new InvalidArgumentException( 'solution ID does not match a current solution' );
	}
}