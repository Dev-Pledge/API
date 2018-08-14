<?php

namespace DevPledge\Integrations\Cache;


use phpDocumentor\Reflection\Types\Mixed_;
use Predis\Client;
use TomWright\JSON\Exception\JSONDecodeException;
use TomWright\JSON\Exception\JSONEncodeException;
use TomWright\JSON\JSON;

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


}