<?php

namespace DevPledge\Domain;

use DevPledge\Integrations\Route\Example;

/**
 * Class Follows
 * @package DevPledge\Domain
 */
class Follows extends AbstractDomain implements Example {
	/**
	 * @var Follow[]
	 */
	protected $follows = [];

	/**
	 * Follows constructor.
	 *
	 * @param array $follows
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $follows ) {
		parent::__construct( 'follow' );
		$this->setFollows( $follows );
	}

	/**
	 * @return Follow[]
	 */
	public function getFollows(): array {
		return $this->follows;
	}

	/**
	 * @param array $follows
	 *
	 * @return $this
	 * @throws \Exception
	 */
	public function setFollows( array $follows ): Follows {
		foreach ( $follows as $follow ) {
			if ( ! $follow instanceof Follow ) {
				throw new \Exception( 'Not Follow' );
			}
		}
		$this->follows = $follows;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->follows = [];
		if ( $this->follows ) {
			foreach ( $this->follows as $follow ) {
				$data->follows[] = $follow->toPersistMap();
			}
		}

		return $data;
	}

	function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->follows = [];
		if ( $this->follows ) {
			foreach ( $this->follows as $follow ) {
				$data->follows[] = $follow->toAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return null|\Closure
	 */
	public static function getExampleResponse(): ?\Closure {

		return function () {
			return static::getExampleInstance()->toAPIMap();
		};
	}

	/**
	 * @return null|\Closure
	 */
	public static function getExampleRequest(): ?\Closure {
		return function () {
			return new \stdClass();
		};
	}

	/**
	 * @return mixed
	 */
	public static function getExampleInstance() {
		static $example;
		if ( ! isset( $example ) ) {
			$follow  = Follow::getExampleInstance();
			$example = new static( [ $follow, $follow, $follow ] );
		}

		return $example;
	}
}