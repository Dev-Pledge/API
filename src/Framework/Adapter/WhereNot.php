<?php

namespace DevPledge\Framework\Adapter;

/**
 * Class WhereNot
 * @package DevPledge\Framework\Adapter
 */
class WhereNot extends Where {
	/**
	 * WhereNot constructor.
	 *
	 * @param string $column
	 * @param string $value
	 */
	public function __construct( string $column, string $value ) {
		parent::__construct( $column, $value, 'not' );
	}
}