<?php

namespace DevPledge\Application\CommandHandlers;

use DevPledge\Application\Commands\CreateSolutionCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\Fetcher\FetchProblem;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\ServiceProviders\SolutionServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Curl\CurlRequest;

/**
 * Class CreateSolutionHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateSolutionHandler extends AbstractCommandHandler {
	/**
	 * CreateProblemHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateSolutionCommand::class );
	}

	/**
	 * @param $command CreateSolutionCommand
	 *
	 * @throws \Exception
	 * @return \DevPledge\Domain\Solution
	 */
	protected function handle( $command ) {

		$data            = $command->getData();
		$data->user_id   = $command->getUser()->getId();
		$solutionService = SolutionServiceProvider::getService();


		if ( ! (
			isset( $data->open_source_location ) &&
			strpos( $data->open_source_location, 'http' ) !== false
		) ) {
			throw new InvalidArgumentException(
				'Open Source Location i.e GitHub Repository Url is Required',
				'open_source_location'
			);
		}
		$curl = new CurlRequest( $data->open_source_location );
		if ( $curl->init()->isHttpCodeError() ) {
			throw new InvalidArgumentException(
				'Open Source Location is giving a ' . $curl->getHttpCode() . ' error',
				'open_source_location'
			);
		}
		if ( ! ( isset( $data->problem_id ) && is_string( $data->problem_id ) ) ) {
			throw new InvalidArgumentException( 'Problem ID is Required', 'problem_id' );
		}
		$problem = new FetchProblem( $data->problem_id );
		if ( ! $problem->isPersistedDataFound() ) {
			throw new InvalidArgumentException( 'Problem ID is not Valid', 'problem_id' );
		}
		if ( ! (
			( ! is_null( $problem->getActiveDatetime() ) ) && $problem->getActiveDatetime() < ( new \DateTime() )
		) ) {
			throw new InvalidArgumentException( 'Problem ID is not activated yet', 'problem_id' );
		}
		if ( ! ( isset( $data->name ) && strlen( $data->name ) > 3 ) ) {
			throw new InvalidArgumentException(
				'Please give your Software Solution a name with more than Characters',
				'name'
			);
		}

		$data->name = trim( $data->name );

		if ( $solutionService->getProblemSolutionWithName( $problem, $data->name ) !== null ) {
			throw new InvalidArgumentException( 'Please choose a unique name for this solution for this problem', 'name' );
		}

		if ( $solutionService->getProblemSolutionWithOpenSourceLocation( $problem, $data->open_source_location ) !== null ) {
			throw new InvalidArgumentException(
				'This Open Source Location is already being used for a solution on this problem',
				'open_source_location'
			);
		}

		return $solutionService->create(
			$data
		);
	}
}