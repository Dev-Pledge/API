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
		$app   = $this->getApp();
		$that  = $this;
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

	/**
	 * @param AbstractMiddleware|null $middleWare
	 *
	 * @return array|AbstractMiddleware[]
	 */
	private function mergeMiddleWare( ?AbstractMiddleware $middleWare = null ) {

		if ( isset( $this->middleware ) && isset( $middleWare ) ) {
			return array_merge( $this->middleware, [ $middleWare ] );
		}
		if ( isset( $this->middleware ) && ! isset( $middleWare ) ) {
			return $this->middleware;
		}
		if ( ! isset( $this->middleware ) && isset( $middleWare ) ) {
			return [ $middleWare ];
		}
		if ( ! isset( $this->middleware ) && ! isset( $middleWare ) ) {
			return [];
		}
	}

	final public function get( $pattern, $callable, ?\Closure $exampleResponse = null, ?AbstractMiddleware $middleWare = null ) {
		AvailableRoutes::AddRoute( new AvailableRoute( 'get', $this->getPattern() . $pattern, null, $exampleResponse, $this->mergeMiddleWare( $middleWare )
		) );

		$route = $this->getApp()->get( $pattern, $callable );
		if ( isset( $middleWare ) ) {
			$route->add( $middleWare );
		}

		return $route;
	}

	/**
	 * @param $pattern
	 * @param $callable
	 * @param null $exampleRequest
	 * @param null $exampleResponse
	 * @param AbstractMiddleware|null $middleWare
	 *
	 * @return \Slim\Interfaces\RouteInterface
	 */
	final public function post( $pattern, $callable, ?\Closure $exampleRequest = null, ?\Closure $exampleResponse = null, ?AbstractMiddleware $middleWare = null ) {
		AvailableRoutes::AddRoute( new AvailableRoute( 'post', $this->getPattern() . $pattern, $exampleRequest, $exampleResponse, $this->mergeMiddleWare( $middleWare ) ) );
		$route = $this->getApp()->post( $pattern, $callable );
		if ( isset( $middleWare ) ) {
			$route->add( $middleWare );
		}

		return $route;
	}

	final public function patch( $pattern, $callable, ?\Closure $exampleRequest = null, ?\Closure $exampleResponse = null, ?AbstractMiddleware $middleWare = null ) {
		AvailableRoutes::AddRoute( new AvailableRoute( 'patch', $this->getPattern() . $pattern, $exampleRequest, $exampleResponse, $this->mergeMiddleWare( $middleWare ) ) );

		$route = $this->getApp()->patch( $pattern, $callable );
		if ( isset( $middleWare ) ) {
			$route->add( $middleWare );
		}

		return $route;
	}

	final public function delete( $pattern, $callable, ?\Closure $exampleResponse = null, ?AbstractMiddleware $middleWare = null ) {
		AvailableRoutes::AddRoute( new AvailableRoute( 'delete', $this->getPattern() . $pattern, null, $exampleResponse, $this->mergeMiddleWare( $middleWare ) ) );

		$route = $this->getApp()->delete( $pattern, $callable );
		if ( isset( $middleWare ) ) {
			$route->add( $middleWare );
		}

		return $route;
	}

	final public function put( $pattern, $callable, ?\Closure $exampleRequest = null, ?\Closure $exampleResponse = null, ?AbstractMiddleware $middleWare = null ) {
		AvailableRoutes::AddRoute( new AvailableRoute( 'put', $this->getPattern() . $pattern, $exampleRequest, $exampleResponse, $this->mergeMiddleWare( $middleWare ) ) );

		$route = $this->getApp()->put( $pattern, $callable );
		if ( isset( $middleWare ) ) {
			$route->add( $middleWare );
		}

		return $route;
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