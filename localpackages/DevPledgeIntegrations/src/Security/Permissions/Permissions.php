<?php


namespace DevPledge\Integrations\Security\Permissions;


use JsonSerializable;

class Permissions implements JsonSerializable
{

    /**
     * @var Resource[]
     */
    private $resources;

    /**
     * Permissions constructor.
     */
    public function __construct()
    {
        $this->resources = [];
    }

    /**
     * @param Resource[] $resources
     * @return Permissions
     */
    public function setResources(array $resources): Permissions
    {
        $this->resources = $resources;
        return $this;
    }

    /**
     * @param Resource $resource
     * @return Permissions
     */
    public function addResource(Resource $resource): Permissions
    {
        $this->resources[] = $resource;
        return $this;
    }

    /**
     * @param string $name
     * @return Resource
     */
    public function getResource(string $name): Resource
    {
        foreach ($this->getResources() as $r) {
            if ($r->getName() === $name) {
                return $r;
            }
        }

        return null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasResource(string $name): bool
    {
        return $this->getResource($name) !== null;
    }

    /**
     * @return Resource[]
     */
    public function getResources(): array
    {
        return $this->resources;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $result = [];
        foreach ($this->resources as $r) {
            $result[$r->getName()] = $r;
        }
        return $result;
    }
}