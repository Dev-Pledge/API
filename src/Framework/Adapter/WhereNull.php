<?php

namespace DevPledge\Framework\Adapter;

/**
 * Class WhereNull
 * @package DevPledge\Framework\Adapter
 */
class WhereNull extends Where{
	/**
	 * WhereNull constructor.
	 *
	 * @param string $column
	 */
	public function __construct( string $column ) {
		parent::__construct( $column, '', 'is null' );
	}
}