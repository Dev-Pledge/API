<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Framework\Controller\Auth\PayController;
use DevPledge\Framework\Middleware\OriginPermission;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;

/**
 * Class PayRouteGroup
 * @package DevPledge\Framework\RouteGroups
 */
class PayRouteGroup extends AbstractRouteGroup {
	/**
	 * PayRouteGroup constructor.
	 */
	public function __construct() {
		parent::__construct( '/pay', [ new Authorise(), new OriginPermission() ] );
	}

	protected function callableInGroup() {
		$this->post( '/pledge/{pledge_id}/stripeToken', PayController::class . ':payPledgeWithStripeToken' );
		$this->post( '/pledge/{pledge_id}/paymentMethod', PayController::class . ':payPledgeWithPaymentMethod' );
		$this->post( '/method/stripe/create', PayController::class . ':createUserStripePaymentMethod' );

	}
}