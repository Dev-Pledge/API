<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 30/08/2018
 * Time: 21:33
 */

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\EntityController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Container;

/**
 * Class EntityControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class EntityControllerDependency extends AbstractControllerDependency {
	/**
	 * EntityControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( EntityController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return EntityController
	 */
	public function __invoke( Container $container ) {
		return new EntityController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return EntityController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}