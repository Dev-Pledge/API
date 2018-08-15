<?php

namespace DevPledge\Framework\Settings;

use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

/**
 * Class StripeSettings
 * @package DevPledge\Framework\Settings
 */
class StripeSettings extends AbstractSetting {
	/**
	 * @var string
	 */
	protected $publicApiKey;
	/**
	 * @var string
	 */
	protected $privateApiKey;


	/**
	 * StripeSettings constructor.
	 */
	public function __construct() {
		parent::__construct( 'Stripe' );
	}


	/**
	 * @param Container $container
	 *
	 * @return StripeSettings
	 */
	public function __invoke( Container $container ) {
		$this->publicApiKey  = getenv( 'STRIPE_PUBLIC' );
		$this->privateApiKey = getenv( 'STRIPE_PRIVATE' );

		return $this;
	}

	/**
	 * @return StripeSettings
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getPrivateApiKey(): string {
		return $this->privateApiKey;
	}

	/**
	 * @return string
	 */
	public function getPublicApiKey(): string {
		return $this->publicApiKey;
	}


}