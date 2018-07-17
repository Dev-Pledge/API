<?php

namespace DevPledge\Domain;


use DevPledge\Application\Mapper\Mappable;

/**
 * Class Organisation
 * @package DevPledge\Domain
 */
class Organisation implements Mappable
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $id
     * @return Organisation
     */
    public function setId(string $id): Organisation
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return Organisation
     */
    public function setName(string $name): Organisation
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return \stdClass
     */
    function toPersistMap(): \stdClass
    {
        return (object)[
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}