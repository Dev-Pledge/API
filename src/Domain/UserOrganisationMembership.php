<?php

namespace DevPledge\Domain;


use DevPledge\Domain\Role\Role;

/**
 * Class UserOrganisationMembership
 * @package DevPledge\Domain
 */
class UserOrganisationMembership
{

    /**
     * @var User
     */
    private $user;

    /**
     * @var Organisation
     */
    private $organisation;

    /**
     * @var Role
     */
    private $role;

    /**
     * @param User $user
     * @return UserOrganisationMembership
     */
    public function setUser(User $user): UserOrganisationMembership
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param Organisation $organisation
     * @return UserOrganisationMembership
     */
    public function setOrganisation(Organisation $organisation): UserOrganisationMembership
    {
        $this->organisation = $organisation;
        return $this;
    }

    /**
     * @param Role $role
     * @return UserOrganisationMembership
     */
    public function setRole(Role $role): UserOrganisationMembership
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return Organisation|null
     */
    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    /**
     * @return Role|null
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

}