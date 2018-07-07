<?php

namespace DevPledge\Integrations\Setting;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Container\AddCallable;

/**
 * Class AddSetting
 * @package DevPledge\Integrations\Setting
 */
class AddSetting extends AddCallable {
	/**
	 * @param AbstractContainerCallable $callable
	 */
	public static function callable( AbstractContainerCallable $callable ) {
		$container = static::$app->getContainer();
		/**
		 * @var $settings Settings;
		 */
		$settings = $container['settings']['integrations'];
		$settings->addSetting( $callable, true );
	}

	/**
	 * @param AbstractSetting $setting
	 */
	public static function setting( AbstractSetting $setting ) {

		static::callable( $setting );

	}

	/**
	 * @param AbstractSetting $setting
	 *
	 * @return $this
	 */
	public function addSetting( AbstractSetting $setting ) {
		static::setting( $setting );

		return $this;
	}
}