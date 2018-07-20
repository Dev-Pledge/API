<?php

namespace DevPledge\Framework\Adapter;

/**
 * Class Wheres
 * @package DevPledge\Framework\Adapter
 */
class Wheres {
	/**
	 * @var Where[]
	 */
	protected $wheres = [];

	/**
	 * Wheres constructor.
	 *
	 * @param array $wheres
	 *
	 * @throws \Exception
	 */
	public function __construct( array $wheres ) {
		foreach ( $wheres as $where ) {
			if ( ! $where instanceof Where ) {
				throw new \Exception( 'Where Not Used' );
			}
		}
		$this->wheres = $wheres;
	}

	public function addWhere( Where $where ) {
		$this->wheres[] = $where;
	}

	/**
	 * @return Where[]
	 */
	public function getWheres() {
		return $this->wheres;
	}
}