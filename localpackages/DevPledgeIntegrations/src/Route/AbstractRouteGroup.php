<?php

namespace DevPledge\Integrations\Route;

use DevPledge\Integrations\AbstractAppAccess;
use DevPledge\Integrations\Middleware\AbstractMiddleware;

/**
 * Class AbstractRouteGroup
 */
abstract class AbstractRouteGroup extends AbstractAppAccess {
	/**
	 * @var string
	 */
	protected $pattern;
	/**
	 * @var AbstractMiddleware[]
	 */
	protected $middleware;
	/**
	 * @var string
	 */
	protected $rootPattern = '';

	/**
	 * AbstractRouteGroup constructor.
	 *
	 * @param $pattern
	 * @param AbstractMiddleware[]|null $middleware
	 *
	 * @throws Exception
	 */
	public function __construct( $pattern, array $middleware = null ) {
		$this->setPattern( $pattern )->setMiddleware( $middleware );
	}


	final public function __invoke() {
		$app  = $this->getApp();
		$that = $this;

		$group = $app->group( $this->getRootPattern(), function () use ( $app, $that ) {
			$app->group( $that->getPattern(),
				function () use ( $that ) {
					$that->callableInGroup();
				}
			);
		} );

		if ( $middleware = $that->getMiddleware() ) {
			foreach ( $middleware as $ware ) {
				$group->add( $ware );
			}
		}

	}

	abstract protected function callableInGroup();

	/**
	 * @param string $pattern
	 *
	 * @return AbstractRouteGroup
	 */
	public function setPattern( string $pattern ): AbstractRouteGroup {
		$this->pattern = $pattern;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPattern(): string {
		return $this->pattern;
	}

	/**
	 * @param array|null $middleware
	 *
	 * @return AbstractRouteGroup
	 * @throws Exception
	 */
	public function setMiddleware( array $middleware = null ): AbstractRouteGroup {
		if ( isset( $middleware ) && is_array( $middleware ) ) {
			foreach ( $middleware as $ware ) {
				if ( ! ( $ware instanceof AbstractMiddleware ) ) {
					throw new Exception( 'Must be Abstract Middleware ' );
				}
			}
		}
		$this->middleware = $middleware;

		return $this;
	}

	/**
	 * @return AbstractMiddleware[] | bool
	 */
	public function getMiddleware() {
		return isset( $this->middleware ) ? $this->middleware : false;
	}

	/**
	 * @param string $rootPattern
	 *
	 * @return AbstractRouteGroup
	 */
	public function setRootPattern( string $rootPattern ): AbstractRouteGroup {
		$this->rootPattern = $rootPattern;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRootPattern(): string {
		return $this->rootPattern;
	}
}