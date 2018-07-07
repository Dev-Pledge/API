<?php

namespace DevPledge\Integrations\Setting\Settings;


use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

/**
 * Class JWTSettings
 * @package DevPledge\Integrations\Setting\Settings
 */
class JWTSettings extends AbstractSetting {

	/**
	 * @var string
	 */
	protected $algorithm;
	/**
	 * @var string
	 */
	protected $secret;
	/**
	 * @var int
	 */
	protected $timeToLive;
	/**
	 * @var int
	 */
	protected $timeToRefresh;

	public function __construct() {
		parent::__construct( 'jwt' );
	}

	/**
	 * @param Container $container
	 *
	 * @return $this
	 */
	public function __invoke( Container $container ) {

		$this->algorithm     = 'SHA256';
		$this->secret        = getenv( 'JWT_SECRET' );
		$this->timeToLive    = 3600;
		$this->timeToRefresh = 7200;

		return $this;
	}

	/**
	 * usually return static::getFromContainer()
	 * @return JWTSettings
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getAlgorithm(): string {
		return $this->algorithm;
	}

	/**
	 * @return string
	 */
	public function getSecret(): string {

		return $this->secret;
	}

	/**
	 * @return int
	 */
	public function getTimeToLive(): int {
		return $this->timeToLive;
	}

	/**
	 * @return int
	 */
	public function getTimeToRefresh(): int {
		return $this->timeToRefresh;
	}


}