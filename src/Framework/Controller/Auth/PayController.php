<?php

namespace DevPledge\Framework\Controller\Auth;


use DevPledge\Application\Commands\CreateStripePaymentMethodCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\PaymentMethod;
use DevPledge\Framework\Controller\AbstractController;
use DevPledge\Framework\ServiceProviders\PaymentMethodServiceProvider;
use DevPledge\Integrations\Command\CommandException;
use DevPledge\Integrations\Command\Dispatch;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class PayController
 * @package DevPledge\Framework\Controller\Auth
 */
class PayController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function createUserStripePaymentMethod( Request $request, Response $response ) {

		$data  = $request->getParsedBody();
		$name  = $data['name'] ?? null;
		$token = $data['token'] ?? null;
		try {
			/**
			 * @var $paymentMethod PaymentMethod
			 */
			$paymentMethod = Dispatch::command( new CreateStripePaymentMethodCommand( $name, $token, $this->getUserFromRequest( $request ) ) );
		} catch ( CommandPermissionException $permissionException ) {
			return $response->withJson( [ 'error' => $permissionException->getMessage() ], 403 );
		} catch ( PaymentException | CommandException $paymentException ) {
			return $response->withJson( [ 'error' => $paymentException->getMessage() ], 401 );
		} catch ( \TypeError $error ) {
			return $response->withJson( [ 'error' => 'input error' ], 500 );
		}

		return $response->withJson( [ 'payment_method' => $paymentMethod->toAPIMap() ] );
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function getUserPaymentMethods( Request $request, Response $response ) {
		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson( [ 'error' => 'user not found' ], 401 );
		}
		try {
			$paymentMethodsService = PaymentMethodServiceProvider::getService();
			$paymentMethods        = $paymentMethodsService->getUserPaymentMethods( $user->getId() );

			return $response->withJson( [ 'payment_methods' => $paymentMethods->toAPIMapArray() ] );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'server error' ], 500 );
		}
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getOrganisationPaymentMethods( Request $request, Response $response ) {
		/**
		 * TODO implement for Organisation
		 */
		$user = $this->getUserFromRequest( $request );
		if ( is_null( $user ) ) {
			return $response->withJson( [ 'error' => 'user not found' ], 401 );
		}
		try {
			$paymentMethodsService = PaymentMethodServiceProvider::getService();
			$paymentMethods        = $paymentMethodsService->getUserPaymentMethods( $user->getId() );

			return $response->withJson( [ 'payment_methods' => $paymentMethods->toAPIMapArray() ] );
		} catch ( \Exception | \TypeError $exception ) {
			return $response->withJson( [ 'error' => 'server error' ], 500 );
		}
	}

	public function createStripePayment( Request $request, Response $response){

	}



}