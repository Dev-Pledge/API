<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Application\Commands\CreateProblemCommand;
use DevPledge\Application\Factory\FactoryException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\ProblemRepositoryDependency;
use DevPledge\Framework\RepositoryDependencies\UserRepositoryDependency;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ProblemGetController
 * @package DevPledge\Framework\Controller\User
 */
class ProblemController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getProblem( Request $request, Response $response ) {
		$id      = $request->getAttribute( 'id' );
		$repo    = ProblemRepositoryDependency::getRepository();
		$problem = $repo->read( $id );
		if ( ! $problem->isPersistedDataFound() ) {
			return $response->withJson(
				[ 'error' => 'Problem not found!' ]
				, 401 );
		}

		return $response->withJson( $problem->toMap() );
	}

	public function createProblem( Request $request, Response $response ) {
		try {
			$user = UserFactoryDependency::getFactory()->createFromRequest( $request );

			$data = (object) $request->getBody();

			try {
				Dispatch::command( new CreateProblemCommand( $data, $user ) );
			} catch ( InvalidArgumentException $exception ) {
				return $response->withJson(
					[ 'error' => 'Problem not created', 'field' => $exception->getField() ]
					, 401 );
			}
		} catch ( FactoryException $exception ) {
			return $response->withJson(
				[ 'error' => 'Problem not created' ]
				, 500 );
		}

	}

}