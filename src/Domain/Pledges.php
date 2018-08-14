<?php

namespace DevPledge\Domain;

/**
 * Class Pledges
 * @package DevPledge\Domain
 */
class Pledges extends AbstractDomain {
	/**
	 * @var Pledge[]
	 */
	protected $pledges = [];

	/**
	 * Pledges constructor.
	 *
	 * @param array $pledges
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $pledges ) {
		$this->setPledges( $pledges );
	}

	/**
	 * @param array $pledges
	 *
	 * @return $this
	 * @throws \Exception
	 */
	public function setPledges( array $pledges ): Pledges {
		foreach ( $pledges as $pledge ) {
			if ( ! $pledge instanceof Pledge ) {
				throw new \Exception( 'Not Pledge' );
			}
		}
		$this->pledges = $pledges;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->pledges = [];
		if ( $this->pledges ) {
			foreach ( $this->pledges as $pledge ) {
				$data->pledges[] = $pledge->toPersistMap();
			}
		}

		return $data;
	}

	public function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->pledges = [];
		if ( $this->pledges ) {
			foreach ( $this->pledges as $pledge ) {
				$data->pledges[] = $pledge->toAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public function toAPIMapArray(): array {
		return $this->toAPIMap()->pledges;
	}
}