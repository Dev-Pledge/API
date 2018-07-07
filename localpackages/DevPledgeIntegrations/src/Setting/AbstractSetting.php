<?php

namespace DevPledge\Integrations\Setting;

use DevPledge\Integrations\Container\AbstractContainerCallable;
use Slim\Container;


/**
 * Class AbstractSetting
 * @package DevPledge\Integrations\Setting
 */
abstract class AbstractSetting extends AbstractContainerCallable {


	public function __construct( string $settingName ) {
		parent::__construct( $settingName );
	}

	/**
	 * usually return static::getFromContainer()
	 * @return mixed
	 */
	abstract static public function getSetting();

	/**
	 * @param Container|null $container
	 *
	 * @return bool|mixed
	 * @throws \Interop\Container\Exception\ContainerException
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public static function getFromContainer( Container $container = null ) {

		if ( ! isset( $container ) ) {
			$container = static::$app->getContainer()->get( 'settings' )['integrations'];
		}
		$class  = static::class;
		$object = new $class();

		return $container->get( $object->getContainerKey() );

	}

}