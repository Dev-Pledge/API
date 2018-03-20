<?php

namespace DevPledge\Application\Command;

use DevPledge\Domain\User;

class CreateOrganisationCommand
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $name;

    /**
     * CreateOrganisation constructor.
     * @param User $user
     * @param string $name
     */
    public function __construct(User $user, string $name)
    {
        if (!($user instanceof User)) {
            throw new \DomainException('User must be instance of ' . User::class);
        }
        $this->user = $user;

        if (! is_string($name)) {
            throw new \DomainException('Incorrect type for name.');
        }
        if (! strlen($name)) {
            throw new \DomainException('Name cannot be an empty string.');
        }
        $this->name = (string) $name;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}