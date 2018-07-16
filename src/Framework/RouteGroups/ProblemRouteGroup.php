<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 23:02
 */

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\User\ProblemController;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

class ProblemRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/problem' );
	}

	protected function callableInGroup() {
		$this->getApp()->post( '/create', ProblemController::class . ':createProblem' )->add( new Authorise() );

		$this->getApp()->get( '/{id}', ProblemController::class . ':getProblem' );


	}
}