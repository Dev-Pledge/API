<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Organisation
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
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(Uuid $id, string $name, \DateTime $createdAt, ?\DateTime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
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
     * @return Organisation
     */
    public function setId(Uuid $id): Organisation
    {
        $this->id = $id;
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
     * @return Organisation
     */
    public function setCreatedAt(\DateTime $createdAt): Organisation
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
     * @return Organisation
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Organisation
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}