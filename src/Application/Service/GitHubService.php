<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Commands\UpdateUserCommand;
use DevPledge\Application\Factory\GitHubUserFactory;
use DevPledge\Domain\GitHubUser;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\User;
use DevPledge\Framework\Settings\GitHubSettings;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Curl\CurlRequest;
use DevPledge\Uuid\Uuid;


/**
 * Class GitHubService
 * @package DevPledge\Application\Service
 */
class GitHubService {

	const GITHUB_ID_KEY = 'gth:';
	const GITHUB_UUID_KEY = 'gud:';
	/**
	 * @var GitHubSettings
	 */
	protected $gitHubSettings;
	/**
	 * @var GitHubUserFactory
	 */
	protected $factory;
	/**
	 * @var Cache
	 */
	protected $cache;

	/**
	 * GitHubService constructor.
	 *
	 * @param GitHubUserFactory $factory
	 * @param GitHubSettings $gitHubSettings
	 * @param Cache $cache
	 */
	public function __construct( GitHubUserFactory $factory, GitHubSettings $gitHubSettings, Cache $cache ) {
		$this->gitHubSettings = $gitHubSettings;
		$this->factory        = $factory;
		$this->cache          = $cache;
	}

	/**
	 * @param string $code
	 * @param string $state
	 * @param User|null $user
	 *
	 * @return GitHubUser
	 */
	public function getGitHubUserByCodeState( string $code, string $state, ?User $user = null ): GitHubUser {

		$gitHubSettings = $this->gitHubSettings;
		$gh             = new CurlRequest( 'https://github.com/login/oauth/access_token' );
		$gh->post()->setData( [
			'client_id'     => $gitHubSettings->getClientId(),
			'client_secret' => $gitHubSettings->getSecret(),
			'code'          => $code,
			'state'         => $state,
			'redirect_uri'  => $gitHubSettings->getRedirectUrl()
		] );
		parse_str( $gh->getResponse(), $preResponse );
		if ( isset( $preResponse['access_token'] ) ) {
			$accessToken = $preResponse['access_token'];
		} else {
			throw new InvalidArgumentException( 'Github Code is not valid' . print_r( $preResponse, true ), 'code' );
		}
		$githubCall = new CurlRequest( 'https://api.github.com/user' );
		$response   = $githubCall->get()->setHeaders(
			[ 'User-Agent' => 'DevPledge API', 'Authorization' => 'token ' . $accessToken ]
		)->getDecodedJsonResponse();
		if ( (
			     isset( $response->message ) && strpos( $response->message, 'Bad Response' ) !== false
		     ) || $githubCall->getHttpCode() == '401' ) {
			throw new InvalidArgumentException( 'Github Access Token not Authorised', 'code' );
		}
		if ( isset( $user ) ) {
			$response->user_id = $user->getId();
		}
		try {
			/**
			 * @var $gitHubUser GitHubUser
			 */
			$gitHubUser = $this->factory->createFromPersistedData( $response );
			$this->updateGitHubCachedUser( $gitHubUser, $user );
		} catch ( \Exception | \TypeError $exception ) {
			throw new InvalidArgumentException( 'Github User Object Generation Failed ' . $exception->getMessage() . print_r( $response ), 'code' );
		}

		return $gitHubUser;
	}

	/**
	 * @param string $userId
	 *
	 * @return GitHubUser|null
	 * @throws \DevPledge\Application\Factory\FactoryException
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function getGitHubUserFromCacheByUserId( string $userId ): ?GitHubUser {
		$response = $this->cache->get( static::GITHUB_UUID_KEY . $userId );
		if ( $response ) {
			return $this->factory->createFromPersistedData( $response );
		}

		return null;
	}

	/**
	 * @param string $gitHubId
	 *
	 * @return GitHubUser|null
	 * @throws \DevPledge\Application\Factory\FactoryException
	 * @throws \DevPledge\Integrations\Cache\CacheException
	 */
	public function getGitHubUserFromCacheByGitHubId( string $gitHubId ): ?GitHubUser {
		$response = $this->cache->get( static::GITHUB_ID_KEY . $gitHubId );
		if ( $response ) {
			return $this->factory->createFromPersistedData( $response );
		}

		return null;
	}

	public function updateGitHubCachedUser( GitHubUser $gitHubUser, ?User $user = null ): GitHubService {
		if ( isset( $user ) ) {
			$gitHubUser->setUuid( $user->getUuid() );
			$this->cache->set( static::GITHUB_UUID_KEY . $gitHubUser->getId(), $gitHubUser->toPersistMap() );
		}
		$this->cache->set( static::GITHUB_ID_KEY . $gitHubUser->getGitHubId(), $gitHubUser->toPersistMap() );

		return $this;
	}

	/**
	 * @param string $state
	 *
	 * @return string
	 */
	public function getAuthoriseUrl( string $state ): string {
		return $this->gitHubSettings->getAuthoriseUrl( $state );
	}

}