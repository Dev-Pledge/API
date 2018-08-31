<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 01/06/2018
 * Time: 14:06
 */

namespace DevPledge\Integrations\Setting\Settings;


use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

class RedisSettings extends AbstractSetting {

	protected $schema;
	protected $host;
	protected $port;

	public function __construct() {
		parent::__construct( 'redis' );
	}

	/**
	 * @param Container $container
	 *
	 * @return mixed
	 */
	public function __invoke( Container $container ) {
		$this->schema = getenv( 'REDIS_SCHEMA' );
		$this->host   = getenv( 'REDIS_HOST' );
		$this->port   = getenv( 'REDIS_PORT' );

		return $this;
	}

	/**
	 * @return RedisSettings
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getSchema(): string {
		return is_string( $this->schema ) ? $this->schema : 'tcp';
	}

	/**
	 * @return string
	 */
	public function getHost(): string {
		return is_string( $this->host ) ? $this->host : 'cache';
	}

	/**
	 * @return int
	 */
	public function getPort(): int {
		return is_int( $this->port ) ? $this->port : 6379;
	}
}