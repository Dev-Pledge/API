<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 12:19
 */

namespace DevPledge\Integrations\ServiceProvider\Services;


use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;
use Slim\Views\PhpRenderer;

/**
 * Class PHPRendererService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class PHPRendererServiceProvider extends AbstractServiceProvider {
	/**
	 * PHPRendererService constructor.
	 */
	public function __construct() {
		parent::__construct( 'renderer' );
	}

	/**
	 * @param Container $container
	 *
	 * @return PhpRenderer|mixed
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$settings = $container->get( 'settings' )['renderer'];

		return new PhpRenderer( $settings['template_path'] );
	}

	/**
	 * @return PhpRenderer
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}