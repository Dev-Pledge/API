<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 12:11
 */

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Monolog\Logger;
use Slim\Container;

/**
 * Class LoggerService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class LoggerServiceProvider extends AbstractServiceProvider {
	/**
	 * LoggerService constructor.
	 */
	public function __construct() {
		parent::__construct( 'logger' );
	}

	/**
	 * @param Container $container
	 *
	 * @return Logger
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$settings = $container->get( 'settings' )['logger'];
		$logger   = new Logger( $settings['name'] );
		$logger->pushProcessor( new UidProcessor() );
		$logger->pushHandler( new StreamHandler( $settings['path'], $settings['level'] ) );

		return $logger;
	}

	/**
	 * @return Logger;
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}