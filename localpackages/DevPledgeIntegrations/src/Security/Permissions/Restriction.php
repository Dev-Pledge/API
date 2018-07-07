<?php


namespace DevPledge\Integrations\Security\Permissions;


use JsonSerializable;

class Restriction implements JsonSerializable
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $values;

    /**
     * Restriction constructor.
     */
    public function __construct()
    {
        $this->values = [];
    }

    /**
     * @param string $name
     * @return Restriction
     */
    public function setName(string $name): Restriction
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $values
     * @return Restriction
     */
    public function setValues(array $values): Restriction
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @param $value
     * @return Restriction
     */
    public function addValue($value): Restriction
    {
        $this->values[] = $value;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param $value
     * @return bool
     */
    public function hasValue($value): bool
    {
        return in_array($value, $this->values);
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
        return $this->values;
    }
}