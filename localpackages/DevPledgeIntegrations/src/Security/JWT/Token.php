<?php

namespace DevPledge\Integrations\Security\JWT;

use DevPledge\Integrations\Security\Permissions\Action;
use DevPledge\Integrations\Security\Permissions\Permissions;
use DevPledge\Integrations\Security\Permissions\Resource;
use DevPledge\Integrations\Security\Permissions\Restriction;

/**
 * Class Token
 * @package DevPledge\Integrations\Security\JWT
 */
class Token
{

    /**
     * @var \stdClass
     */
    private $payload;

    /**
     * @var Permissions
     */
    private $permissions;

    /**
     * Token constructor.
     * @param \stdClass $payload
     */
    public function __construct(\stdClass $payload)
    {
        $this->payload = $payload;
        $this->permissions = new Permissions();

        $perms = $this->getData()->perms ?? new \stdClass();
        foreach ($perms as $resName => $actions) {
            $resource = new Resource();
            $resource->setName($resName);

            foreach ($actions as $actionName => $restrictions) {
                $action = new Action();
                $action->setName($actionName);

                foreach ($restrictions as $restrictionName => $restrictionValue) {
                    $restriction = new Restriction();
                    $restriction->setName($restrictionName);
                    $restriction->setValues($restrictionValue);
                }
            }

            $this->permissions->addResource($resource);
        }
    }

    /**
     * @return \stdClass
     */
    public function getPayload(): object
    {
        return $this->payload ?? new \stdClass();
    }

    /**
     * @return \stdClass
     */
    public function getData(): object
    {
        return $this->getPayload()->data ?? new \stdClass();
    }

    /**
     * @return int|null
     */
    public function getTtl(): ?int
    {
        return $this->getPayload()->ttl ?? null;
    }

    /**
     * @return int|null
     */
    public function getTtr(): ?int
    {
        return $this->getPayload()->ttr ?? null;
    }

    /**
     * @throws InvalidTokenException
     */
    public function checkLiveTime(): bool
    {
        $ttr = $this->getTtl();

        if (!is_numeric($ttr ?? null)) {
            throw new InvalidTokenException('Missing or invalid TTL');
        }

        $now = time();

        if ($ttr < $now) {
            throw new InvalidTokenException('TTL has expired');
        }

        return true;
    }

    /**
     * @throws InvalidTokenException
     */
    public function checkRefreshTime(): bool
    {
        $ttr = $this->getTtr();

        if (!is_numeric($ttr ?? null)) {
            throw new InvalidTokenException('Missing or invalid TTR');
        }

        $now = time();

        if ($ttr < $now) {
            throw new InvalidTokenException('TTR has expired');
        }

        return true;
    }

}