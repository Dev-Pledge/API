<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 20:54
 */

namespace DevPledge\Integrations\Handler\Handlers;


use DevPledge\Integrations\Handler\AbstractHandler;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class NotAllowedHandler
 * @package DevPledge\Integrations\Handler\Handlers
 */
class NotAllowedHandler extends AbstractHandler {
	/**
	 * NotAllowedHandler constructor.
	 */
	public function __construct() {
		parent::__construct( 'notAllowedHandler' );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $methods
	 *
	 * @return Response
	 */
	function __invoke( Request $request, Response $response ) {
		$data                    = new \stdClass();
		$data->error             = 'Not Allowed';
		$data->errorStatus       = '405';
		$data->sentRequestBody   = $request->getBody();
		$data->sentRequestMethod = $request->getMethod();
		$data->sentAttributes    = $request->getAttributes();
		$data->sentParams        = $request->getParams();

		return $response->withJson( $data )->withStatus( 405 );
	}
}