<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class UserGroup
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Uuid|null
     */
    private $problemId;

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
     * ProblemSolutionGroup constructor.
     * @param Uuid $id
     * @param Uuid|null $problemId
     * @param string $name
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(Uuid $id, ?Uuid $problemId, string $name, \DateTime $createdAt, ?\DateTime $updatedAt)
    {
        $this->id = $id;
        $this->problemId = $problemId;
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
     * @return UserGroup
     */
    public function setId(Uuid $id): UserGroup
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Uuid|null
     */
    public function getProblemId(): Uuid
    {
        return $this->problemId;
    }

    /**
     * @param Uuid|null $problemId
     * @return UserGroup
     */
    public function setProblemId(?Uuid $problemId): UserGroup
    {
        $this->problemId = $problemId;
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
     * @return UserGroup
     */
    public function setName(string $name): UserGroup
    {
        $this->name = $name;
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
     * @return UserGroup
     */
    public function setCreatedAt(\DateTime $createdAt): UserGroup
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
     * @return UserGroup
     */
    public function setUpdatedAt(?\DateTime $updatedAt): UserGroup
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}