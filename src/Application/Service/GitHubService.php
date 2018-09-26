<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\GitHubUserFactory;
use DevPledge\Domain\GitHubUser;
use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\User;
use DevPledge\Framework\Settings\GitHubSettings;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Curl\CurlRequest;



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
		if ( isset( $response['access_token'] ) ) {
			$accessToken = $preResponse['access_token'];
		} else {
			throw new InvalidArgumentException( 'Github Code is not valid', 'code' );
		}
		$githubCall = new CurlRequest( 'https://api.github.com/user/' );
		$response   = $githubCall->get()->setHeaders(
			[ 'Authorization' => 'token ' . $accessToken ]
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
			$this->cache->set( static::GITHUB_ID_KEY . $gitHubUser->getGitHubId(), $gitHubUser->toPersistMap() );
			if ( isset( $user ) ) {
				$this->cache->set( static::GITHUB_UUID_KEY . $gitHubUser->getId(), $gitHubUser->toPersistMap() );
			}
		} catch ( \Exception | \TypeError $exception ) {
			throw new InvalidArgumentException( 'Github User Object Generation Failed', 'code' );
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

}