<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 22:10
 */

namespace DevPledge\Integrations\Handler;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use Slim\Container;

class HandlerCaller extends AbstractContainerCallable {
	/**
	 * @var AbstractHandler
	 */
	protected $handler;

	public function __construct( AbstractHandler $handler ) {
		$this->setHandler( $handler );
		parent::__construct( $handler->getContainerKey() );
	}

	/**
	 * @param Container $container
	 *
	 * @return AbstractHandler|mixed
	 */
	public function __invoke( Container $container ) {
		return $this->getHandler();
	}

	/**
	 * @param AbstractHandler $handler
	 *
	 * @return HandlerCaller
	 */
	public function setHandler( AbstractHandler $handler ): HandlerCaller {
		$this->handler = $handler;

		return $this;
	}

	/**
	 * @return AbstractHandler
	 */
	public function getHandler(): AbstractHandler {
		return $this->handler;
	}
}