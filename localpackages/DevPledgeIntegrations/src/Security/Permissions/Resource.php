<?php


namespace DevPledge\Integrations\Security\Permissions;


use JsonSerializable;

class Resource implements JsonSerializable
{

    /**
     * @var Action[]
     */
    private $actions;

    /**
     * @var string
     */
    private $name;

    /**
     * Resource constructor.
     */
    public function __construct()
    {
        $this->actions = [];
    }

    /**
     * @param Action[] $actions
     * @return static
     */
    public function setActions(array $actions): self
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * @param Action $action
     * @return static
     */
    public function addAction(Action $action): self
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * @param string $name
     * @return Action
     */
    public function getAction(string $name): Action
    {
        foreach ($this->getActions() as $r) {
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
    public function hasAction(string $name): bool
    {
        return $this->getAction($name) !== null;
    }

    /**
     * @param string $name
     * @return Resource
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Action[]
     */
    public function getActions(): array
    {
        return $this->actions;
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
        foreach ($this->actions as $a) {
            $result->{$a->getName()} = $a;
        }
        return $result;
    }
}