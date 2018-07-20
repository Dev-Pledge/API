<?php

namespace DevPledge\Framework\Controller\Problem;


use DevPledge\Application\Commands\CreateProblemCommand;
use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\Problem;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\ProblemRepositoryDependency;
use DevPledge\Integrations\Command\Dispatch;
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
	 */
	public function getProblem( Request $request, Response $response ) {
		$id      = $request->getAttribute( 'id' );
		$repo    = ProblemRepositoryDependency::getRepository();
		$problem = $this->readFromRepo( $repo, $id );
		if ( is_null( $problem ) ) {
			return $response->withJson(
				[ 'error' => 'Problem not found!' ]
				, 401 );
		}

		return $response->withJson( $problem->toPersistMap() );
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

}