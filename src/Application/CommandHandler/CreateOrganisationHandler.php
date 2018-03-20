<?php

namespace DevPledge\Application\CommandHandler;

use DevPledge\Application\Command\CreateOrganisationCommand;
use DevPledge\Application\Service\OrganisationService;

class CreateOrganisationHandler
{
    /**
     * @var OrganisationService
     */
    private $organisationService;

    /**
     * CreateOrganisation constructor.
     * @param OrganisationService $organisationService
     */
    public function __construct(OrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    /**
     * @param CreateOrganisationCommand $command
     * @return \DevPledge\Domain\Organisation
     */
    public function handle(CreateOrganisationCommand $command)
    {
        $org = $this->organisationService->create($command->getName());
        // TODO: $this->organisationService->setOwner($command->getUser());
        // Or something similar...
        return $org;
    }
}