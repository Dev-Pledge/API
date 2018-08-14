<?php

namespace DevPledge\Framework\Settings;

use DevPledge\Integrations\Integrations;
use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

/**
 * Class FixerIOSettings
 * @package DevPledge\Framework\Settings
 */
class FixerIOSettings extends AbstractSetting {
	/**
	 * @var string
	 */
	protected $apiAccessKey;
	/**
	 * @var string
	 */
	protected $cacheDir;

	/**
	 * FixerIO constructor.
	 */
	public function __construct() {
		parent::__construct( 'FixerIO' );
	}


	/**
	 * @param Container $container
	 *
	 * @return FixerIOSettings
	 */
	public function __invoke( Container $container ) {
		$this->apiAccessKey = getenv( 'FIXERIO' );
		$this->cacheDir     = Integrations::getBaseDir() . '/data/fixerio';

		return $this;
	}

	/**
	 * @return FixerIOSettings
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getApiAccessKey(): string {
		return $this->apiAccessKey;
	}

	/**
	 * @return string
	 */
	public function getCacheDir(): string {
		return $this->cacheDir;
	}
}