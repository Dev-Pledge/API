<?php

namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\CreateStripePaymentMethodCommand;
use DevPledge\Domain\CommandPermissionException;
use DevPledge\Domain\Organisation;
use DevPledge\Framework\ServiceProviders\PaymentServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateStripePaymentMethodHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateStripePaymentMethodHandler extends AbstractCommandHandler {
	/**
	 * CreateStripePaymentMethodHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateStripePaymentMethodCommand::class );
	}


	/**
	 * @param $command CreateStripePaymentMethodCommand
	 *
	 * @return \DevPledge\Domain\PaymentMethod
	 * @throws CommandPermissionException
	 * @throws \DevPledge\Domain\PaymentException
	 */
	protected function handle( $command ) {
		$user           = $command->getUser();
		$token          = $command->getToken();
		$organisationId = $command->getOrganisationId();
		$name           = $command->getName() ?? 'default card';
		if ( ! is_null( $organisationId ) ) {
			CommandPermissionException::tryOrganisationPermission( $user, $organisationId, 'create' );
			/**
			 * TODO add organisation service stuff here to get $organisation object
			 */
			$domain = new Organisation();
		} else {
			$domain = $user;
		}

		$paymentService = PaymentServiceProvider::getService();

		return $paymentService->createPaymentMethodFromStripeToken( $domain, $token, $name );
	}
}