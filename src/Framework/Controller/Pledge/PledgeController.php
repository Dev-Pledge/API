<?php

namespace DevPledge\Framework\Controller\Pledge;

use DevPledge\Application\Commands\CreatePledgeCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Framework\Controller\AbstractController;
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
				, 401 );
		} catch ( InvalidArgumentException $exception ) {
			return $response->withJson(
				[ 'error' => $exception->getMessage(), 'field' => $exception->getField() ]
				, 401 );
		}


		return $response->withJson( $pledge->toAPIMap() );
	}

}