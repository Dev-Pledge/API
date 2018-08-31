<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 22:05
 */

namespace DevPledge\Integrations\Handler;


use DevPledge\Integrations\Container\AbstractContainerCallable;
use DevPledge\Integrations\Container\AddCallable;
use DevPledge\Integrations\Extrapolate\AbstractExtrapolateForContainer;

/**
 * Class ExtrapolateHandlers
 * @package DevPledge\Integrations\Handler
 */
class ExtrapolateHandlers extends AbstractExtrapolateForContainer {
	/**
	 * ExtrapolateHandlers constructor.
	 *
	 * @param $path
	 * @param $nameSpace
	 */
	public function __construct( $path, $nameSpace ) {
		parent::__construct( $path, $nameSpace, HandlerCaller::class );
	}

	/**
	 * @param AbstractContainerCallable $callable
	 */
	protected function add( AbstractContainerCallable $callable ) {
		AddCallable::callable( $callable);
	}
}