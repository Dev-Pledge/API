<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\GitHubServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class GitHubUserController
 * @package DevPledge\Framework\Controller\User
 */
class GitHubUserController extends AbstractController {
	/**
	 * @return \DevPledge\Application\Service\GitHubService
	 */
	private function getGitHubService() {
		return GitHubServiceProvider::getService();
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getUserByGithubId( Request $request, Response $response ) {
		$GitHubId = $request->getAttribute( 'github_id' );
		try {
			$ghUser = $this->getGitHubService()->getGitHubUserFromCacheByGitHubId( $GitHubId );
			if ( $ghUser !== null ) {
				return $response->withJson( $ghUser->toPublicAPIMap() );
			}

			return $response->withJson( [ 'error' => 'github user not found' ], 404 );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'server error ' . $exception->getMessage() ], 500 );
		}
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getUserByUserId( Request $request, Response $response ) {
		$userId = $request->getAttribute( 'user_id' );
		try {
			$ghUser = $this->getGitHubService()->getGitHubUserFromCacheByUserId( $userId );
			if ( $ghUser !== null ) {
				return $response->withJson( $ghUser->toPublicAPIMap() );
			}

			return $response->withJson( [ 'error' => 'github user not found' ], 404 );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'server error ' . $exception->getMessage() ], 500 );
		}
	}

}