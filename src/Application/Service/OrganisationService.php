<?php

namespace DevPledge\Application\Service;

use DevPledge\Application\Factory\OrganisationFactory;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;

class OrganisationService
{
    /**
     * @var OrganisationRepository $repo
     */
    protected $repo;
    /**
     * @var OrganisationFactory $factory
     */
    private $factory;

    /**
     * OrganisationService constructor.
     * @param OrganisationFactory $factory
     * @param OrganisationRepository $repo
     */
    public function __construct(OrganisationFactory $factory, OrganisationRepository $repo)
    {
        $this->factory = $factory;
        $this->repo = $repo;
    }

    /**
     * @param string $name
     * @return \DevPledge\Domain\Organisation
     */
    public function create(string $name)
    {
        $organisation = $this->factory->create([
            'name' => $name,
        ]);
        $this->repo->saveOrganisation($organisation);
        return $organisation;
    }
}