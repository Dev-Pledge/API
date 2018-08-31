<?php


namespace DevPledge\Integrations\Security\Permissions;


use JsonSerializable;

/**
 * Class Action
 * @package DevPledge\Integrations\Security\Permissions
 */
class Action implements JsonSerializable
{

    /**
     * @var Restriction[]
     */
    private $restrictions;

    /**
     * @var string
     */
    private $name;

    /**
     * Action constructor.
     */
    public function __construct()
    {
        $this->restrictions = [];
    }

    /**
     * @param Restriction[] $restrictions
     * @return Action
     */
    public function setRestrictions(array $restrictions): Action
    {
        $this->restrictions = $restrictions;
        return $this;
    }

    /**
     * @param Restriction $restriction
     * @return Action
     */
    public function addRestriction(Restriction $restriction): Action
    {
        $this->restrictions[] = $restriction;
        return $this;
    }

    /**
     * @param string $name
     * @return Action
     */
    public function setName(string $name): Action
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Restriction[]
     */
    public function getRestrictions(): array
    {
        return $this->restrictions;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
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
        $result = new \stdClass();
        foreach ($this->restrictions as $r) {
            $result->{$r->getName()} = $r;
        }
        return $result;
    }
}