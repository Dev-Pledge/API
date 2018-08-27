<?php

namespace DevPledge\Domain;

/**
 * Class Follows
 * @package DevPledge\Domain
 */
class Follows extends AbstractDomain {
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
}