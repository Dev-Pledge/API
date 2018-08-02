<?php


namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Problem\ProblemController;
use DevPledge\Framework\Middleware\ResourcePermission;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

class ProblemRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/problem' );
	}

	protected function callableInGroup() {
		$this->getApp()->post( '/create', ProblemController::class . ':createProblem' )->add( new ResourcePermission( 'problems', 'create' ) )->add( new Authorise() );

		$this->getApp()->get( '/get/{id}', ProblemController::class . ':getProblem' );

		$this->getApp()->get( '/get-user-problems/{id}', ProblemController::class . ':getUserProblems' );

	}
}