<?php

namespace DevPledge\Domain;

/**
 * Class Problems
 * @package DevPledge\Domain
 */
class Problems extends AbstractDomain {
	/**
	 * @var Problem[]
	 */
	protected $problems = [];

	/**
	 * Problems constructor.
	 *
	 * @param array $problems
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $problems ) {
		parent::__construct( 'problem' );
		$this->setProblems( $problems );
	}

	/**
	 * @param array $problems
	 *
	 * @return $this
	 * @throws \Exception
	 */
	public function setProblems( array $problems ): Problems {
		foreach ( $problems as $problem ) {
			if ( ! $problem instanceof Problem ) {
				throw new \Exception( 'Not Problem' );
			}
		}
		$this->problems = $problems;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->problems = [];
		if ( $this->problems ) {
			foreach ( $this->problems as $problem ) {
				$data->problems[] = $problem->toPersistMap();
			}
		}

		return $data;
	}

	public function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->problems = [];
		if ( $this->problems ) {
			foreach ( $this->problems as $problem ) {
				$data->problems[] = $problem->toAPIMapWithComments();
			}
		}

		return $data;
	}
}