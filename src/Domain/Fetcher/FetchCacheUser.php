<?php

namespace DevPledge\Domain\Fetcher;

use DevPledge\Domain\User;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchCacheUser
 * @package DevPledge\Domain\Fetcher
 */
class FetchCacheUser extends User {
	/**
	 * FetchCacheUser constructor.
	 *
	 * @param $userId
	 */
	public function __construct( $userId ) {

		parent::__construct( 'user' );

		try {
			$userService = UserServiceProvider::getService();
			$user        = $userService->getUserFromCache( $userId );
			$this
				->setUuid( $user->getUuid() )
				->setName( $user->getName() )
				->setUsername( $user->getUsername() )
				->setCreated( $user->getCreated() )
				->setModified( $user->getModified() )
				->setEmail( $user->getEmail() )
				->setDeveloper( $user->isDeveloper() );

		} catch ( \Exception | \TypeError $exception ) {
			$this
				->setName( 'unknown' )
				->setUsername( 'unknown' )
				->setEmail( 'unknown' );

			Sentry::get()->captureException( $exception );
		}
	}

}