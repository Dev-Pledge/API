<?php

namespace DevPledge\Application\CommandHandlers;

use DevPledge\Application\Commands\CreateOrganisationCommand;
use DevPledge\Framework\ServiceProviders\OrganisationServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateOrganisationHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateOrganisationHandler extends AbstractCommandHandler {

	/**
	 * CreateOrganisationHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreateOrganisationCommand::class );
	}

	/**
	 * @param $command CreateOrganisationCommand
	 *
	 * @return \DevPledge\Domain\Organisation
	 * @throws \Exception
	 */
	public function handle( $command ) {
		// TODO: $this->organisationService->setOwner($command->getUser());
		return OrganisationServiceProvider::getService()->create( $command->getName() );
	}
}