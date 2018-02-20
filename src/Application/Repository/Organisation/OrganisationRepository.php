<?php

namespace DevPledge\Application\Repository\Organisation;


use DevPledge\Domain\Organisation;

interface OrganisationRepository
{

    /**
     * @param int $id
     * @return Organisation
     */
    public function getOrganisation(int $id): Organisation;

    /**
     * @param array $filters
     * @return Organisation[]
     */
    public function searchOrganisations(array $filters): array;

    /**
     * @param Organisation $organisation
     * @return Organisation
     */
    public function saveOrganisation(Organisation $organisation): Organisation;

}