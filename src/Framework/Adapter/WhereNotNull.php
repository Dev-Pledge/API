<?php

namespace DevPledge\Framework\Adapter;

/**
 * Class WhereNotNull
 * @package DevPledge\Framework\Adapter
 */
class WhereNotNull extends Where {
	/**
	 * WhereNotNull constructor.
	 *
	 * @param string $column
	 * @param string $value
	 */
	public function __construct( string $column, string $value ) {
		parent::__construct( $column, $value, 'is not null' );
	}
}