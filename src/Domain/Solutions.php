<?php

namespace DevPledge\Domain;

/**
 * Class Solutions
 * @package DevPledge\Domain
 */
class Solutions extends AbstractDomain {
	/**
	 * @var Solution[]
	 */
	protected $solutions = [];
	/**
	 * @var User | null;
	 */
	protected $user;

	/**
	 * Solutions constructor.
	 *
	 * @param array $solutions
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $solutions ) {
		parent::__construct( 'solution' );
		$this->setSolutions( $solutions );
	}

	public function setSolutions( array $solutions ) {
		foreach ( $solutions as $solution ) {
			if ( ! $solution instanceof Solution ) {
				throw new \Exception( 'Not Solution' );
			}
		}

		$this->solutions = $solutions;
	}

	/**
	 * @return array
	 */
	public function getSolutions(): array {

		return $this->solutions;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();
		if ( isset( $this->user ) ) {
			$data->user = $this->user->toPersistMap();
		}
		$data->solutions = [];
		if ( $this->solutions ) {
			foreach ( $this->solutions as $solution ) {
				$data->solutions[] = $solution->toPersistMap();
			}
		}

		return $data;
	}

	/**
	 * @return \stdClass
	 */
	public function toAPIMap(): \stdClass {
		$data = new \stdClass();
		if ( isset( $this->user ) ) {
			$data->user = $this->user->toPublicAPIMap();
		}
		$data->solutions = [];
		if ( $this->solutions ) {
			foreach ( $this->solutions as $solution ) {
				$data->solutions[] = $solution->toAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public function toAPIMapArray(): array {
		return $this->toAPIMap()->solutions;
	}


}