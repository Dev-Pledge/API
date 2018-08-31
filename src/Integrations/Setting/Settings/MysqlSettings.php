<?php

namespace DevPledge\Integrations\Setting\Settings;


use DevPledge\Integrations\Setting\AbstractSetting;
use Slim\Container;

/**
 * Class MysqlSettings
 * @package DevPledge\Integrations\Setting\Settings
 */
class MysqlSettings extends AbstractSetting {
	/**
	 * MysqlSettings constructor.
	 */
	public function __construct() {
		parent::__construct( 'mysql' );
	}

	/**
	 * @var string
	 */
	protected $dsn;
	/**
	 * @var string
	 */
	protected $password;
	/**
	 * @var string
	 */
	protected $userName;

	/**
	 * @param Container $container
	 *
	 * @return MysqlSettings
	 */
	public function __invoke( Container $container ) {
		$this->dsn      = 'mysql:dbname=' . getenv( 'MYSQL_DB' ) . ';host=' . getenv( 'MYSQL_HOST' );
		$this->password = getenv( 'MYSQL_PASSWORD' );
		$this->userName = getenv( 'MYSQL_USER' );

		return $this;
	}

	/**
	 * @return MysqlSettings
	 * @throws \Interop\Container\Exception\ContainerException
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	static public function getSetting() {
		return static::getFromContainer();
	}

	/**
	 * @return string
	 */
	public function getDsn(): string {
		return $this->dsn;
	}

	/**
	 * @return string
	 */
	public function getPassword():string {
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getUserName(): string {
		return $this->userName;
	}
}