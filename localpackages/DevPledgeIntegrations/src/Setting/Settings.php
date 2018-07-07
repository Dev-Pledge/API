<?php

namespace DevPledge\Integrations\Setting;

use Slim\Container;


/**
 * Class Settings
 * @package DevPledge\Integrations\Setting
 */
final class Settings extends Container {
	/**
	 * Settings constructor.
	 *
	 * @param array $values
	 */
	public function __construct( array $values = [] ) {
		foreach ( $values as $key => $value ) {
			$this->offsetSet( $key, $value );
		}
	}

	/**
	 * @return bool
	 */
	protected function displayErrorDetails() {
		if ( getenv( 'production' ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param array $container
	 *
	 * @return $this
	 */
	public function addInitialSetting( $container = [] ) {
		parent::__construct( $container );
		if ( ! isset( $this['settings']['displayErrorDetails'] ) ) {
			$this['settings']['displayErrorDetails'] = $this->displayErrorDetails();
		}
		if ( ! isset( $this['settings']['addContentLengthHeader'] ) ) {
			$this['settings']['addContentLengthHeader'] = false;
		}
		if ( ! isset( $this['settings']['integrations'] ) ) {
			$this['settings']['integrations'] = new static();
		}

		return $this;
	}

	/**
	 * @param AbstractSetting $setting
	 * @param bool $overWrite
	 *
	 * @return $this
	 */
	public function addSetting( AbstractSetting $setting, $overWrite = false ) {
		$container = $this;
		if ( $overWrite ) {
			$this[ $setting->getContainerKey() ] = function () use ( $container, $setting ) {
				return $setting( $container );
			};
		} else if ( ! isset( $this[ $setting->getContainerKey() ] ) ) {
			$this[ $setting->getContainerKey() ] = function () use ( $container, $setting ) {
				return $setting( $container );
			};
		}

		return $this;
	}


}