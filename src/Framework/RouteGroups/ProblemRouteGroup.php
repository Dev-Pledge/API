<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Pledge\PledgeController;
use DevPledge\Framework\Controller\Problem\ProblemController;
use DevPledge\Framework\Controller\Problem\SolutionController;
use DevPledge\Framework\Middleware\ResourcePermission;
use DevPledge\Integrations\Middleware\JWT\Authorise;
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

		$this->post( '/create', ProblemController::class . ':createProblem' )
		     ->add( $createProblemsMiddleWare );

		$this->patch( '/{problem_id}', ProblemController::class . ':updateProblem' )
		     ->add( $createProblemsMiddleWare );

		$this->get( '/{problem_id}', ProblemController::class . ':getProblem' );

		$this->get( 's/user/{user_id}', ProblemController::class . ':getUserProblems' );

		$this->post( '/{problem_id}/solution', SolutionController::class . ':createSolution' )
		     ->add( new ResourcePermission( 'solutions', 'create' ) );

		$this->post( '/{problem_id}/pledge', PledgeController::class . ':createPledge' )->add( new Authorise() );

	}
}