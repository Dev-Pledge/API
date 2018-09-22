<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 21/08/2018
 * Time: 19:16
 */

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Auth\PayController;
use DevPledge\Framework\Middleware\OriginPermission;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

class PayRouteGroup extends AbstractRouteGroup {
	public function __construct() {
		parent::__construct( '/pay', [ new Authorise(), new OriginPermission() ] );
	}

	protected function callableInGroup() {
		$this->post( '/pledge/{pledge_id}/stripeToken', PayController::class . ':payPledgeWithStripeToken' );
		$this->post( '/pledge/{pledge_id}/paymentMethod', PayController::class . ':payPledgeWithPaymentMethod' );
		
	}
}