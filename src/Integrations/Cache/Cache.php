<?php

namespace DevPledge\Integrations\Cache;

use TomWright\JSON\Exception\JSONDecodeException;
use TomWright\JSON\Exception\JSONEncodeException;
use TomWright\JSON\JSON;
use Predis\Client;
use Predis\Collection\Iterator\HashKey;
use Predis\Collection\Iterator\Keyspace;

/**
 * Class Cache
 * @package DevPledge\Integrations\Cache
 */
class Cache {
	protected $client;
	protected $json;

	/**
	 * Cache constructor.
	 *
	 * @param Client $client
	 * @param JSON $json
	 */
	public function __construct( Client $client, JSON $json ) {
		$this->client = $client;
		$this->json   = $json;
	}

	/**
	 * @return Client
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return $this
	 * @throws CacheException
	 */
	public function set( string $key, $value ): Cache {
		try {
			$this->getClient()->set( $key, $this->json->encode( $value ) );
		} catch ( JSONEncodeException $exception ) {
			throw new CacheException( $exception->getMessage() );
		}

		return $this;
	}

	/**
	 * @param string $key
	 * @param $value
	 * @param int $ttl
	 *
	 * @return Cache
	 * @throws CacheException
	 */
	public function setEx( string $key, $value, int $ttl = 10 ): Cache {
		try {
			$this->getClient()->setex( $key, $ttl, $this->json->encode( $value ) );
		} catch ( JSONEncodeException $exception ) {
			throw new CacheException( $exception->getMessage() );
		}

		return $this;
	}

	/**
	 * @param $key
	 *
	 * @return bool|\stdClass
	 * @throws CacheException
	 */
	public function get( $key ) {
		try {
			$returnValue = $this->getClient()->get( $key );
			if ( $returnValue ) {
				return $this->json->decode( $returnValue );
			}
		} catch ( JSONDecodeException $exception ) {
			throw new CacheException( $exception->getMessage() );
		}

		return false;
	}

	/**
	 * @return JSON
	 */
	public function getJson() {
		return $this->json;
	}

	/**
	 * @param string $match
	 * @param int $count
	 * @param \Closure|null $keyValFunction
	 *
	 * @return array
	 */
	public function matchIterate( string $match, int $count = 10, ?\Closure $keyValFunction = null ): array {
		$returnArray = [];
		foreach ( new Keyspace( $this->getClient(), $match, $count ) as $key ) {
			try {
				$value = $this->get( $key );
			} catch ( CacheException $exception ) {
				$value = null;
			}
			if ( isset( $keyValFunction ) ) {
				if ( isset( $keyValFunction ) ) {
					$keyValFunction( $key, $value );
				}
			}
			$returnArray[] = $value;

		}

		return $returnArray;

	}



}