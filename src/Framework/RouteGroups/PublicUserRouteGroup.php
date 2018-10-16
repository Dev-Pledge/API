<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\GitHubUser;
use DevPledge\Framework\Controller\User\GitHubUserController;
use DevPledge\Framework\Controller\User\UserController;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class UserRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class PublicUserRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/public' );
	}


	protected function callableInGroup() {

		$this->get(
			'/user/{username}',
			UserController::class . ':getProfileInfoByUsername', UserController::getExampleResponse()
		);
		$this->get(
			'/github/id/{github_id}',
			GitHubUserController::class . ':getUserByGithubId', GitHubUser::getExampleResponse()
		);
		$this->get(
			'/github/{$user_id}',
			GitHubUserController::class . ':getUserByUserId', GitHubUser::getExampleResponse()
		);
	}
}