<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 20:41
 */

namespace DevPledge\Integrations\Container;


use DevPledge\Integrations\AbstractAppAccess;
use Slim\Container;

/**
 * Class ContainerKey
 * @package DevPledge\Integrations\Container
 */
abstract class AbstractContainerKey extends AbstractAppAccess {
	/**
	 * @var string;
	 */
	protected $containerKey;

	/**
	 * AbstractContainerCallable constructor.
	 *
	 * @param null $containerKey
	 */
	public function __construct( $containerKey ) {
		$this->setContainerKey( $containerKey );
	}


	/**
	 * @return string
	 */
	public function getContainerKey(): string {
		return $this->containerKey;
	}

	/**
	 * @param string $containerKey
	 *
	 * @return AbstractContainerCallable
	 */
	public function setContainerKey( string $containerKey ): AbstractContainerKey {
		$this->containerKey = $containerKey;

		return $this;
	}

	/**
	 * @param Container|null $container
	 *
	 * @return mixed
	 */
	public static function getFromContainer( Container $container = null ) {
		if ( ! isset( $container ) ) {
			$container = static::$app->getContainer();
		}
		$class  = static::class;
		$object = new $class();

		return $container->get( $object->getContainerKey() );

	}


}