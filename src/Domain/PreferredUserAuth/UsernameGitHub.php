<?php

namespace DevPledge\Domain\PreferredUserAuth;


use DevPledge\Domain\InvalidArgumentException;
use DevPledge\Domain\User;
use DevPledge\Framework\ServiceProviders\GitHubServiceProvider;


/**
 * Class UsernameGitHub
 * @package DevPledge\Domain\PreferredUserAuth
 */
class UsernameGitHub implements PreferredUserAuth {

	use UsernameTrait;
	/**
	 * @var string
	 */
	private $state;
	/**
	 * @var string
	 */
	private $code;
	/**
	 * @var string | null;
	 */
	private $gitHubId;


	/**
	 * UsernameGitHub constructor.
	 *
	 * @param string $username
	 * @param string $code
	 * @param string $state
	 */
	public function __construct( string $username, string $code, string $state ) {
		$this->username = $username;
		$this->code     = $code;
		$this->state    = $state;
	}

	/**
	 * @return bool
	 * @throws PreferredUserAuthValidationException
	 */
	public function validate(): void {

		$this->validateUsername();
		try {
			$gitHubUser     = GitHubServiceProvider::getService()->getGitHubUserByCodeState( $this->getCode(), $this->getState() );
			$this->gitHubId = $gitHubUser->getGitHubId();
		} catch ( InvalidArgumentException $exception ) {
			throw new PreferredUserAuthValidationException( $exception->getMessage(), $exception->getField() );
		}
	}

	/**
	 * @param User $user
	 */
	public function updateUserWithAuth( User $user ): void {
		$user->setGitHubId( $this->getGithubId() );
	}

	/**
	 * @return int
	 */
	public function getCode(): string {
		return $this->code;
	}

	/**
	 * @return AuthDataArray
	 */
	public function getAuthDataArray() {
		return new AuthDataArray(
			[
				'github_id' => $this->getGithubId(),
				'username'  => $this->getUsername(),
			]
		);
	}

	/**
	 * @return null|string
	 */
	public function getGitHubId(): ?string {
		return $this->gitHubId;
	}

	/**
	 * @return string
	 */
	public function getState(): string {
		return $this->state;
	}


}