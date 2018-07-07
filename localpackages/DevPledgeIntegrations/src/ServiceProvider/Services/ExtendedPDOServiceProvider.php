<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 02:42
 */

namespace DevPledge\Integrations\ServiceProvider\Services;

use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\Setting\Settings\MysqlSettings;
use Slim\Container;
use TomWright\Database\ExtendedPDO\ExtendedPDO;

/**
 * Class ExtendedPDOService
 * @package DevPledge\Integrations\ServiceProvider\Services
 */
class ExtendedPDOServiceProvider extends AbstractServiceProvider {
	/**
	 * ExtendedPDOService constructor.
	 */
	public function __construct() {
		parent::__construct( ExtendedPDO::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ExtendedPDO
	 * @throws \Interop\Container\Exception\ContainerException
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function __invoke( Container $container ) {
		$settings = MysqlSettings::getSetting();
		$db       = new ExtendedPDO(
			$settings->getDsn(),
			$settings->getUserName(),
			$settings->getPassword()
		);
		$db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

		return $db;
	}

	/**
	 * @return ExtendedPDO;
	 */
	public static function getService() {
		return static::getFromContainer();
	}
}