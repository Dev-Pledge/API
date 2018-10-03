<?php

namespace DevPledge\Framework\Controller\Pledge;

use DevPledge\Application\Commands\CreatePledgeCommand;
use DevPledge\Application\Commands\UpdatePledgeWithSolution;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\Pledge;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Integrations\Command\Dispatch;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class PledgeController
 * @package DevPledge\Framework\Controller\Pledge
 */
class PledgeController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 */
	public function createPledge( Request $request, Response $response ) {

		$user      = $this->getUserFromRequest( $request );
		$data      = $this->getStdClassFromRequest( $request );
		$problemId = $request->getAttribute( 'problem_id' );

		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		try {
			/**
			 * @var $pledge Pledge
			 */
			$pledge = Dispatch::command( new CreatePledgeCommand( $problemId, $data, $user ) );
		} catch ( CommandPermissionException | \TypeError $permException ) {
			return $response->withJson(
				[ 'error' => 'Permission Denied' ]
				, 403 );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $pledge->toAPIMap() );
	}


	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function getUserPledges( Request $request, Response $response ) {

		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 403 );
		}
		$pledgeService = PledgeServiceProvider::getService();

		$pledges = $pledgeService->getUserPledges( $user->getId() );

		return $response->withJson( [
			$pledges->toAPIMap()
		] );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function updatePledgeWithSolution( Request $request, Response $response ) {
		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 403 );
		}
		$data = $this->getStdClassFromRequest( $request );
		if ( ! isset( $data->solution_id ) ) {
			return $response->withJson(
				[ 'error' => 'No Solution ID', 'field' => 'solution_id' ]
				, 401 );
		}
		$solutionId = $data->solution_id;
		$pledgeId   = $request->getAttribute( 'pledge_id' );
		try {
			/**
			 * @var $pledge Pledge
			 */
			$pledge = Dispatch::command( new UpdatePledgeWithSolution( $pledgeId, $solutionId, $user ) );
		} catch ( CommandPermissionException $commandException ) {
			return $response->withJson(
				[ 'error' => 'Permission Denied' ]
				, 403 );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson(
				[ 'error' => 'Server Error ' . $exception->getMessage() ]
				, 500 );
		}

		return $response->withJson( [ $pledge->toAPIMap() ] );
	}

}