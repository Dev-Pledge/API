<?php

namespace DevPledge\Framework\Settings;


use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

/**
 * Class GitHubSettings
 * @package DevPledge\Integrations\Setting\Settings
 */
class GitHubSettings extends AbstractSetting {
	/**
	 * @var string
	 */
	protected $clientId;
	/**
	 * @var string
	 */
	protected $secret;
	/**
	 * @var string
	 */
	protected $redirectUrl;

	public function __construct() {
		parent::__construct( 'github' );
	}

	/**
	 * @param Container $container
	 *
	 * @return $this
	 */
	public function __invoke( Container $container ) {
		$this->clientId    = getenv( 'GITHUB_CLIENT_ID' );
		$this->secret      = getenv( 'GITHUB_SECRET' );
		$this->redirectUrl = getenv( 'GITHUB_REDIRECT_URL' );

		return $this;
	}

	/**
	 * @return $this
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getSecret(): string {
		return $this->secret;
	}

	/**
	 * @return string
	 */
	public function getClientId(): string {
		return $this->clientId;
	}

	/**
	 * @return string
	 */
	public function getRedirectUrl(): string {
		return $this->redirectUrl;
	}

	/**
	 * @param string|null $state
	 *
	 * @return string
	 */
	public function getAuthoriseUrl( string $state = null ) {
		$state       = $state ?? md5( rand( 1000, 2000 ) );
		$clientId    = $this->getClientId() ?? '';
		$redirectUrl = urlencode( ( $this->getRedirectUrl() ?? '' ) );

		return "https://github.com/login/oauth/authorize?client_id={$clientId}&redirect_uri={$redirectUrl}&state={$state}";
	}

}