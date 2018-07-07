<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 20:33
 */

namespace DevPledge\Integrations\Handler\Handlers;


use DevPledge\Integrations\Handler\AbstractHandler;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class NotFoundHandler
 * @package DevPledge\Integrations\Handler\Handlers
 */
class NotFoundHandler extends AbstractHandler {
	public function __construct() {
		parent::__construct( 'notFoundHandler' );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $methods
	 *
	 * @return Response
	 */
	public function __invoke( Request $request, Response $response ) {

		$data                    = new \stdClass();
		$data->error             = 'Not Found';
		$data->errorStatus       = '404';
		$data->sentRequestBody   = $request->getBody();
		$data->sentRequestMethod = $request->getMethod();
		$data->sentAttributes    = $request->getAttributes();
		$data->sentParams        = $request->getParams();

		return $response->withJson( $data )->withStatus( 404 );
	}
}