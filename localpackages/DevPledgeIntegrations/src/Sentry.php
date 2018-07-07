<?php

namespace DevPledge\Integrations;

/**
 * Class Sentry
 * @package DevPledge\Integrations
 */
class Sentry {
	/**
	 * @var \Raven_Client
	 */
	protected static $client;

	/**
	 * @param \Raven_Client $client
	 *
	 * @return \Raven_Client
	 */
	static public function setSentry( \Raven_Client $client ) {
		$error_handler = new \Raven_ErrorHandler( $client );
		$error_handler->registerExceptionHandler();
		$error_handler->registerErrorHandler();
		$error_handler->registerShutdownFunction();
		return static::$client = $client;
	}

	/**
	 * @return \Raven_Client |null
	 */
	static public function get() {
		return static::$client;
	}
}