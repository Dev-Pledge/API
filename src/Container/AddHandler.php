<?php

namespace DevPledge\Container;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AddHandler
 * @package DevPledge\Container
 */
class AddHandler extends ContainerBase {
	/**
	 * @var string
	 */
	protected $handlerName;
	/**
	 * @var \Closure
	 */
	protected $handlerFunction;

	/**
	 * AddHandler constructor.
	 *
	 * @param $handlerName
	 * @param \Closure $handlerFunction
	 */
	public function __construct( $handlerName, \Closure $handlerFunction ) {
		$this->setHandlerName( $handlerName )
		     ->setHandlerFunction( $handlerFunction )
		     ->do();
	}

	/**
	 * @return string
	 */
	protected function getHandlerName(): string {
		return $this->handlerName;
	}

	/**
	 * @param string $handlerName
	 *
	 * @return AddHandler
	 */
	protected function setHandlerName( string $handlerName ): AddHandler {
		$this->handlerName = $handlerName;

		return $this;
	}

	/**
	 * @return \Closure
	 */
	protected function getHandlerFunction(): \Closure {
		return $this->handlerFunction;
	}

	/**
	 * @param \Closure $handlerFunction
	 *
	 * @return $this
	 */
	protected function setHandlerFunction( \Closure $handlerFunction ) {
		$this->handlerFunction = $handlerFunction;

		return $this;
	}

	protected function do() {
		$this->addContainerHandler();
	}

	/**
	 * @return $this
	 */
	protected function addContainerHandler() {
		$appContainer                            = $this->getApp()->getContainer();
		$appContainer[ $this->getHandlerName() ] = function ( Container $container ) {
			return function ( Request $request, Response $response ) use ( $container ) {
				return call_user_func_array( $this->getHandlerFunction(), array( $request, $response, $container ) );
			};
		};

		return $this;
	}

}