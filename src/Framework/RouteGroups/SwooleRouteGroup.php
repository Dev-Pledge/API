<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Command\TestCommand;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class SwooleRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class SwooleRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/swooletest' );
	}

	protected function callableInGroup() {
		$this->getApp()->get( '/command', function () {
			Dispatch::command( new TestCommand( 'funky' ) );

		} );
		$this->getApp()->get( '/launch', function () {

			shell_exec( 'php /var/www/swooletest.php > /dev/null 2>/dev/null &' );

		} );
	}
}