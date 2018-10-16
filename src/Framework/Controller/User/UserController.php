<?php

namespace DevPledge\Framework\Controller\User;


use DevPledge\Domain\Comment;
use DevPledge\Domain\GitHubUser;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Problems;
use DevPledge\Domain\Solution;
use DevPledge\Domain\User;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\GitHubServiceProvider;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Framework\ServiceProviders\SolutionServiceProvider;
use DevPledge\Framework\ServiceProviders\StatusCommentServiceProvider;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Class UserController
 * @package DevPledge\Framework\Controller\User
 */
class UserController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function getProfileInfoByUsername( Request $request, Response $response ) {
		$username = $request->getAttribute( 'username' );

		$cacheService = CacheServiceProvider::getService();

		if ( $responseSerialised = $cacheService->get( 'pi:' . $username ) ) {
			return $response->withJson( unserialize( $responseSerialised ) );
		}

		$userService     = UserServiceProvider::getService();
		$problemService  = ProblemServiceProvider::getService();
		$solutionService = SolutionServiceProvider::getService();
		$githubService   = GitHubServiceProvider::getService();
		$statusService   = StatusCommentServiceProvider::getService();
		$pledgesService  = PledgeServiceProvider::getService();
		try {
			$user       = $userService->getUserFromUsernameCache( $username );
			$problems   = $problemService->readAll( $user->getId() );
			$solutions  = $solutionService->getUserSolutions( $user->getId() );
			$statuses   = $statusService->getUserStatuses( $user->getId() );
			$githubUser = null;
			if ( ! is_null( $user->getGitHubId() ) ) {
				$githubUser = $githubService->getGitHubUserFromCacheByGitHubId( $user->getGitHubId() );
			}
			$pledgesCount = $pledgesService->getUserPledgesCount( $user->getId() );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'User Not Found' ], 404 );
		}
		$responseArray = [

			'user'          => $user->toPublicAPIMap(),
			'github_user'   => ( is_null( $githubUser ) ? null : $githubUser->toPublicAPIMap() ),
			'problems'      => $problems->toAPIMap()->problems,
			'solutions'     => $solutions->toAPIMap()->solutions,
			'statuses'      => $statuses->toAPIMap()->comments,
			'pledges_count' => $pledgesCount ?? 0,
		];
		$cacheService->setEx( 'pi:' . $username, serialize( $responseArray ), 10000 );

		return $response->withJson( $responseArray );
	}

	/**
	 * @return \Closure
	 */
	public static function getExampleResponse() {
		return function () {
			return (object) [
				'user'          => User::getExampleInstance()->toPublicAPIMap(),
				'github_user'   => GitHubUser::getExampleInstance()->toPublicAPIMap(),
				'problems'      => [ Problem::getExampleInstance()->toPublicAPIMap() ],
				'solutions'     => [ Solution::getExampleInstance()->toPublicAPIMap() ],
				'statuses'      => [ Comment::getExampleInstance()->toPublicAPIMap() ],
				'pledges_count' => 20,
			];
		};
	}

}