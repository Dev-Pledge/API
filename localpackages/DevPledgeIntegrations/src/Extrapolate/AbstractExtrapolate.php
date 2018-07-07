<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 26/03/2018
 * Time: 23:48
 */

namespace DevPledge\Integrations\Extrapolate;

use QuickCache\Cache;

/**
 * Class AbstractExtrapolate
 * @package DevPledge\Integrations\Extrapolate
 */
abstract class AbstractExtrapolate {

	/**
	 * @var string
	 */
	protected $nameSpace;
	/**
	 * @var string
	 */
	protected $path;
	/**
	 * @var AbstractContainerCallable | null
	 */
	protected $adapterClass;
	/**
	 * @var null|false|\stdClass
	 */
	protected static $cacheData;

	/**
	 * @var Cache
	 */
	protected static $cache;

	/**
	 * AbstractExtrapolate constructor.
	 *
	 * @param $path
	 * @param $nameSpace
	 * @param null $adapterClass
	 */
	public function __construct( $path, $nameSpace, $adapterClass = null ) {
		$this->setPath( $path )->setNameSpace( $nameSpace );
		$this->setAdapterClass( $adapterClass );
	}

	protected function getPhpFilesFromCache() {
		$fileName = 'ExtrapolationFiles';
		if ( ( $CacheDir = Extrapolate::getCachedExtrapolationsDir() ) && static::$cacheData ) {
			if ( ! ( static::$cache instanceof ExtrapolationsCache ) ) {
				static::$cache = new ExtrapolationsCache();
			}
			static::$cache->setCachePath( $CacheDir );
			static::$cacheData = static::$cache->getCacheData( $fileName );

		}
		if ( static::$cacheData ) {
			if ( isset( static::$cacheData->{$this->getPathForCache()} ) ) {
				return static::$cacheData->{$this->getPathForCache()};
			}
		}

		return false;
	}

	protected function saveToCache( $phpFiles ) {
		$fileName = 'ExtrapolationFiles';
		if ( ! ( static::$cacheData instanceof \stdClass ) ) {
			static::$cacheData = new \stdClass();
		}
		if (
			isset( static::$cacheData->{$this->getPathForCache()} ) &&
			static::$cacheData->{$this->getPathForCache()} === $phpFiles
		) {
			return false;
		}
		static::$cacheData->{$this->getPathForCache()} = $phpFiles;
		if ( ! ( static::$cache instanceof ExtrapolationsCache ) ) {
			static::$cache = new ExtrapolationsCache();
		}
		static::$cache->saveToCache( $fileName, static::$cacheData );
	}

	public function __invoke() {
		$phpFiles = $this->getPhpFilesFromCache();
		if ( is_dir( $this->path ) ) {
			$phpFiles = ( isset( $phpFiles ) && $phpFiles ) ? $phpFiles : glob( $this->path . '/*.php' );
			if ( count( $phpFiles ) && $phpFiles ) {
				foreach ( $phpFiles as $filename ) {
					$split     = explode( '/', $filename );
					$className = str_replace( '.php', '', end( $split ) );
					$class     = $this->nameSpace . '\\' . $className;
					if ( $adapterClass = $this->getAdapterClass() ) {

						$this->extrapolate( new $adapterClass( new $class ) );

					} else {
						$this->extrapolate( new $class() );
					}

				}
				$this->saveToCache( $phpFiles );
			}
		}
	}

	/**
	 * @param string $path
	 *
	 * @return AbstractExtrapolateForContainer
	 */
	public function setPath( string $path ): AbstractExtrapolate {
		$this->path = rtrim( $path, '/' );

		return $this;
	}

	private function getPathForCache() {
		return str_replace( '/', '~', $this->path );
	}

	/**
	 * @param string $nameSpace
	 *
	 * @return AbstractExtrapolateForContainer
	 */
	public function setNameSpace( string $nameSpace ): AbstractExtrapolate {
		$this->nameSpace = $nameSpace;

		return $this;
	}

	/**
	 * @param callable $callable
	 */
	protected function extrapolate( callable $callable ) {
		call_user_func( $callable );
	}

	/**
	 * @param string | null $adapterClass
	 *
	 * @return AbstractExtrapolateForContainer
	 */
	protected function setAdapterClass( string $adapterClass = null ) {
		$this->adapterClass = $adapterClass;

		return $this;
	}

	/**
	 * @return string|bool
	 */
	protected function getAdapterClass() {
		if ( isset( $this->adapterClass ) ) {
			return $this->adapterClass;
		}

		return false;
	}
}