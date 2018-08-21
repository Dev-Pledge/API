<?php


namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreatePledgePaymentUsingMethodCommand;
use DevPledge\Application\Service\PaymentMethodService;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\Payment;
use DevPledge\Framework\ServiceProviders\PaymentMethodServiceProvider;
use DevPledge\Framework\ServiceProviders\PaymentServiceProvider;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;
use DevPledge\Integrations\Command\CommandException;

/**
 * Class CreatePledgePaymentUsingMethodHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreatePledgePaymentUsingMethodHandler extends AbstractCommandHandler {

	public function __construct() {
		parent::__construct( CreatePledgePaymentUsingMethodCommand::class );
	}


	/**
	 * @param $command
	 *
	 * @return \DevPledge\Domain\Payment|null
	 * @throws CommandException
	 * @throws CommandPermissionException
	 * @throws \DevPledge\Domain\PaymentException
	 */
	protected function handle( $command ) {
		$user            = $command->getUser();
		$pledgeId        = $command->getPledgeId();
		$paymentMethodId = $command->getPaymentMethodId();

		$pledgeService        = PledgeServiceProvider::getService();
		$paymentMethodService = PaymentMethodServiceProvider::getService();
		$paymentService       = PaymentServiceProvider::getService();
		$pledge               = $pledgeService->read( $pledgeId );
		if ( ! $pledge->isPersistedDataFound() ) {
			throw new CommandException( 'Pledge not found' );
		}
		$paymentMethod = $paymentMethodService->read( $paymentMethodId );
		if ( ! $paymentMethod->isPersistedDataFound() ) {
			throw new CommandException( 'Payment Method not found' );
		}
		CommandPermissionException::tryException( $pledge, $user, 'write' );
		CommandPermissionException::tryException( $paymentMethod, $user, 'create' );

		return $paymentService->payWithStripePaymentMethod( $paymentMethodId, $pledge->getCurrencyValue(), function ( $response, Payment $payment ) use ( $pledgeService, $pledge ) {

			$pledgeService->update( $pledge, (object) [ 'payment_id' => $payment->getId() ] );

			return $payment;
		} );
	}
}