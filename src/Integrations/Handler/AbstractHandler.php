<?php

namespace DevPledge\Integrations\Handler;

use DevPledge\Integrations\Container\AbstractContainerKey;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AbstractHandler
 * @package DevPledge\Integrations\Handler
 */
abstract class AbstractHandler extends AbstractContainerKey {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return mixed
	 */
	abstract function __invoke( Request $request, Response $response );
}