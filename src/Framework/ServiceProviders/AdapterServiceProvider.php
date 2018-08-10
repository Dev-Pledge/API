<?php


namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

/**
 * Class AdapterServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class AdapterServiceProvider extends AbstractServiceProvider {

	public function __construct() {
		parent::__construct( 'dbAdapter' );
	}

	/**
	 * @param Container $container
	 *
	 * @return MysqlAdapter
	 */
	public function __invoke( Container $container ) {
		return new MysqlAdapter( ExtendedPDOServiceProvider::getService() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return MysqlAdapter
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}