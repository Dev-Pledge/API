<?php

namespace DevPledge\Framework\RouteGroups;


use DevPledge\Domain\Payment;
use DevPledge\Framework\Controller\Auth\PayController;
use DevPledge\Framework\Middleware\OriginPermission;
use DevPledge\Framework\Settings\StripeSettings;
use DevPledge\Integrations\Middleware\JWT\Authorise;
use DevPledge\Integrations\Route\AbstractRouteGroup;
use Slim\Http\Request;
use Slim\Http\Response;

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
		$this->post( '/pledge/{pledge_id}/stripeToken', PayController::class . ':payPledgeWithStripeToken', Payment::getExampleRequest() ,Payment::getExampleResponse());
		$this->post( '/pledge/{pledge_id}/paymentMethod', PayController::class . ':payPledgeWithPaymentMethod' );
		$this->post( '/method/stripe/create', PayController::class . ':createUserStripePaymentMethod' );
		$this->get( '/stripe/apiKey', function ( Request $request, Response $response ) {
			return $response->withJson( [ 'api_key' => StripeSettings::getSetting()->getPublicApiKey() ] );
		}, function () {
			return (object) [ 'api_key' => 'woiugbdwef923hoascdkjcn' ];
		} );

	}
}