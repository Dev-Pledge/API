<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Application\Commands\TestCommand;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use DevPledge\Integrations\ServiceProvider\Services\RedisServiceProvider;

/**
 * Class SwooleRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class SwooleRouteGroup extends AbstractRouteGroup {

	public function __construct() {
		parent::__construct( '/swooletest' );
	}

	protected function callableInGroup() {

		$this->getApp()->get( '/launch', function () {

			shell_exec( 'php /var/www/swooletest.php > /dev/null 2>/dev/null &' );

		} );

		$this->getApp()->get( '/redis', function () {
//			RedisServiceProvider::getService()->set( 'test2', gzcompress( serialize( array( 'yes' => 'no' ) ), 9 ), 'ex', 30 );
			$x =  RedisServiceProvider::getService()->get( 'test2' );
			var_dump( $x );
		} );

	}
}