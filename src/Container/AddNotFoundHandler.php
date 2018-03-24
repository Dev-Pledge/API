<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 20/03/2018
 * Time: 14:00
 */

namespace DevPledge\Container;

/**
 * Class AddNotFoundHandler
 * @package DevPledge\Application\Container
 */
class AddNotFoundHandler extends AddHandler {
	public function __construct( \Closure $handlerFunction ) {
		parent::__construct( 'notFoundHandler', $handlerFunction );
	}
}