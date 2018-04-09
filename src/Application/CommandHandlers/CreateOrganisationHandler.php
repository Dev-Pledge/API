<?php

namespace DevPledge\Application\CommandHandlers;

use DevPledge\Application\Commands\CreateOrganisationCommand;
use DevPledge\Application\Services\OrganisationService;
use DevPledge\Framework\ServiceProviders\OrganisationServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class CreateOrganisationHandler
 * @package DevPledge\Application\CommandHandlers
 */
class CreateOrganisationHandler extends AbstractCommandHandler {

	/**
	 * CreateOrganisation constructor.
	 *
	 * @param OrganisationService $organisationService
	 */
	public function __construct() {
		parent::__construct( CreateOrganisationCommand::class );
	}

	/**
	 * @param CreateOrganisationCommand $command
	 *
	 * @return \DevPledge\Domain\Organisation
	 */
	public function handle( $command ) {
		// TODO: $this->organisationService->setOwner($command->getUser());
		return OrganisationServiceProvider::getService()->create( $command->getName() );
	}
}