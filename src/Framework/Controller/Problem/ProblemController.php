<?php

namespace DevPledge\Framework\Controller\Problem;


use DevPledge\Application\Commands\CreateProblemCommand;
use DevPledge\Application\Commands\UpdateProblemCommand;
use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\Problem;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\RepositoryDependencies\ProblemRepositoryDependency;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Integrations\Command\Dispatch;
use http\Exception;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ProblemController
 * @package DevPledge\Framework\Controller\Problem
 */
class ProblemController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function getProblem( Request $request, Response $response ) {
		$problemId = $request->getAttribute( 'problem_id' );

		$problemService = ProblemServiceProvider::getService();
		try {
			$problem = $problemService->read( $problemId );
			if ( !$problem->isPersistedDataFound() ) {
				throw new \Exception( 'Not Found!' );
			}
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson(
				[ 'error' => 'Problem not found!' ]
				, 401 );
		}

		return $response->withJson( $problem->toAPIMapWithComments() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 */
	public function createProblem( Request $request, Response $response ) {

		$user = $this->getUserFromRequest( $request );
		$data = $this->getStdClassFromRequest( $request );

		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		try {
			/**
			 * @var $problem Problem
			 */
			$problem = Dispatch::command( new CreateProblemCommand( $data, $user ) );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $problem->toAPIMap() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 */
	public function updateProblem( Request $request, Response $response ) {

		$user      = $this->getUserFromRequest( $request );
		$data      = $this->getStdClassFromRequest( $request );
		$problemId = $request->getAttribute( 'problem_id' );


		try {
			/**
			 * @var $problem Problem
			 */
			$problem = Dispatch::command( new UpdateProblemCommand( $problemId, $data, $user ) );
		} catch ( CommandPermissionException | \TypeError $permException ) {
			return $response->withJson(
				[ 'error' => 'Permission Denied' ]
				, 401 );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $problem->toAPIMap() );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function getUserProblems( Request $request, Response $response ) {
		$userId         = $request->getAttribute( 'user_id' );
		$problemService = ProblemServiceProvider::getService();
		$problems       = $problemService->readAll( $userId );
		if ( $problems->countProblems()==0) {
			return $response->withJson(
				[ 'error' => 'Problems not found!' ]
				, 401 );
		}

		return $response->withJson( $problems->toAPIMap() );
	}
}