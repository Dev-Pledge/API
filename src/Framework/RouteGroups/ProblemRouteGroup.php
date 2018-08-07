<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Problem\ProblemController;
use DevPledge\Framework\Middleware\ResourcePermission;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class ProblemRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class ProblemRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/problem' );
	}

	protected function callableInGroup() {

		$createProblemsMiddleWare = new ResourcePermission( 'problems', 'create' );

		$this->getApp()->post( '/create', ProblemController::class . ':createProblem' )
		     ->add( $createProblemsMiddleWare );

		$this->getApp()->patch( '/{problem_id}', ProblemController::class . ':updateProblem' )
		     ->add( $createProblemsMiddleWare );

		$this->getApp()->get( '/get/{id}', ProblemController::class . ':getProblem' );

		$this->getApp()->get( '/get-user-problems/{user_id}', ProblemController::class . ':getUserProblems' );

	}
}