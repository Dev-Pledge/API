<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Currency
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $abbreviation;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * User constructor.
     * @param Uuid $id
     * @param string $name
     * @param string $abbreviation
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(Uuid $id, string $name, string $abbreviation, \DateTime $createdAt, ?\DateTime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @param Uuid $id
     * @return Currency
     */
    public function setId(Uuid $id): Currency
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Currency
     */
    public function setName(string $name): Currency
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->name;
    }

    /**
     * @param string $abbreviation
     * @return Currency
     */
    public function setAbbreviation(string $abbreviation): Currency
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Currency
     */
    public function setCreatedAt(\DateTime $createdAt): Currency
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return Currency
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Currency
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}