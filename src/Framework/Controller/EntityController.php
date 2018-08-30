<?php

namespace DevPledge\Framework\Controller;

use DevPledge\Framework\ServiceProviders\EntityServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class EntityController
 * @package DevPledge\Framework\Controller
 */
class EntityController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getFeedEntities( Request $request, Response $response ) {
		$entityService = EntityServiceProvider::getService();
		$data          = $this->getStdClassFromRequest( $request );
		$apiData       = $entityService->getFeedEntities( $data );

		return $response->withJson( $apiData );
	}
}