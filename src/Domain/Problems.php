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
	 * @var User | null;
	 */
	protected $user;

	/**
	 * Problems constructor.
	 *
	 * @param array $problems
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $problems, ?User $user = null ) {
		parent::__construct( 'problem' );
		foreach ( $problems as $problem ) {
			if ( ! $problem instanceof Problem ) {
				throw new \Exception( 'Not Problem' );
			}
		}
		$this->user     = $user;
		$this->problems = $problems;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();
		if(isset($this->user)){
			$data->user = $this->user->toAPIMap();
		}
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
		if(isset($this->user)){
			$data->user = $this->user->toAPIMap();
		}
		$data->problems = [];
		if ( $this->problems ) {
			foreach ( $this->problems as $problem ) {
				$data->problems[] = $problem->toAPIMap();
			}
		}

		return $data;
	}
}