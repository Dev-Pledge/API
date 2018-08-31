<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 12:08
 */

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;
use TomWright\JSON\JSON;

/**
 * Class JSONService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class JSONServiceProvider extends AbstractServiceProvider {
	/**
	 * JSONService constructor.
	 */
	public function __construct() {
		parent::__construct( JSON::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return mixed|JSON
	 */
	public function __invoke( Container $container ) {
		return new JSON();
	}


	/**
	 * @return JSON
	 */
	public static function getService() {
		return static::getFromContainer();
	}
}