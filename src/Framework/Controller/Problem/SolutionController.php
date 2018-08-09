<?php


namespace DevPledge\Framework\Controller\Problem;


use DevPledge\Application\Commands\CreateSolutionCommand;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Integrations\Command\Dispatch;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class SolutionController
 * @package DevPledge\Framework\Controller\Problem
 */
class SolutionController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \DevPledge\Integrations\Command\CommandException
	 */
	public function createSolution( Request $request, Response $response ) {

		$user             = $this->getUserFromRequest( $request );
		$data             = $this->getStdClassFromRequest( $request );
		$data->problem_id = $request->getAttribute( 'problem_id' );
		if ( is_null( $user ) ) {
			return $response->withJson(
				[ 'error' => 'No User Found' ]
				, 401 );
		}
		try {
			/**
			 * @var $problem Problem
			 */
			$solution = Dispatch::command( new CreateSolutionCommand( $data, $user ) );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $solution->toAPIMap() );
	}
}