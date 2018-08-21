<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreatePledgePaymentUsingStripeTokenCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\Payment;
use DevPledge\Framework\ServiceProviders\PaymentServiceProvider;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class CreatePledgePaymentUsingStripeTokenHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreatePledgePaymentUsingStripeTokenHandler extends AbstractCommandHandler {
	/**
	 * CreatePledgePaymentUsingStripeTokenHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreatePledgePaymentUsingStripeTokenCommand::class );
	}

	/**
	 * @param $command CreatePledgePaymentUsingStripeTokenCommand
	 *
	 * @return Payment|null
	 * @throws CommandException
	 * @throws CommandPermissionException
	 * @throws \DevPledge\Domain\PaymentException
	 */
	protected function handle( $command ) {
		$user     = $command->getUser();
		$token    = $command->getToken();
		$pledgeId = $command->getPledgeId();

		$pledgeService  = PledgeServiceProvider::getService();
		$paymentService = PaymentServiceProvider::getService();

		$pledge = $pledgeService->read( $pledgeId );
		if ( ! $pledge->isPersistedDataFound() ) {
			throw new CommandException( 'Pledge not found' );
		}

		CommandPermissionException::tryException( $pledge, $user, 'write' );

		return $paymentService->stripePayWithToken(
			$token,
			$pledge->getCurrencyValue(),
			function ( $response, Payment $payment ) use ( $pledgeService, $pledge ) {

				$pledgeService->update( $pledge, (object) [ 'payment_id' => $payment->getId() ] );

				return $payment;
			}
		);
	}
}