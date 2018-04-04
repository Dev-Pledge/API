<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Problem
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Uuid
     */
    private $userId;

    /**
     * @var Uuid
     */
    private $organisationId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $specification;

    /**
     * @var \DateTime
     */
    private $lastActive;

    /**
     * @var \DateTime|null
     */
    private $deadline;

    /**
     * @var Repo|null
     */
    private $repo;

    /**
     * @var bool
     */
    private $deleted = false;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * Problem constructor.
     * @param Uuid $id
     * @param Uuid $userId
     * @param Uuid $organisationId
     * @param string $title
     * @param string $description
     * @param string $specification
     * @param \DateTime $lastActive
     * @param \DateTime|null $deadline
     * @param Repo|null $repo
     * @param bool $deleted
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $userId,
        Uuid $organisationId,
        string $title,
        string $description,
        string $specification,
        \DateTime $lastActive,
        ?\DateTime $deadline,
        ?Repo $repo,
        bool $deleted = false,
        \DateTime $createdAt,
        ?\DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->organisationId = $organisationId;
        $this->title = $title;
        $this->description = $description;
        $this->specification = $specification;
        $this->lastActive = $lastActive;
        $this->deadline = $deadline;
        $this->repo = $repo;
        $this->deleted = $deleted;
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
     * @return Problem
     */
    public function setId(Uuid $id): Problem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getUserId(): Uuid
    {
        return $this->userId;
    }

    /**
     * @param Uuid $userId
     * @return Problem
     */
    public function setUserId(Uuid $userId): Problem
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getOrganisationId(): Uuid
    {
        return $this->organisationId;
    }

    /**
     * @param Uuid $organisationId
     * @return Problem
     */
    public function setOrganisationId(Uuid $organisationId): Problem
    {
        $this->organisationId = $organisationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Problem
     */
    public function setTitle(string $title): Problem
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Problem
     */
    public function setDescription(string $description): Problem
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecification(): string
    {
        return $this->specification;
    }

    /**
     * @param string $specification
     * @return Problem
     */
    public function setSpecification(string $specification): Problem
    {
        $this->specification = $specification;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastActive(): \DateTime
    {
        return $this->lastActive;
    }

    /**
     * @param \DateTime $lastActive
     * @return Problem
     */
    public function setLastActive(\DateTime $lastActive): Problem
    {
        $this->lastActive = $lastActive;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }

    /**
     * @param \DateTime|null $deadline
     * @return Problem
     */
    public function setDeadline(?\DateTime $deadline): Problem
    {
        $this->deadline = $deadline;
        return $this;
    }

    /**
     * @return Repo|null
     */
    public function getRepo(): ?Repo
    {
        return $this->repo;
    }

    /**
     * @param Repo|null $repo
     * @return Problem
     */
    public function setRepo(?Repo $repo): Problem
    {
        $this->repo = $repo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     * @return Problem
     */
    public function setDeleted(bool $deleted): Problem
    {
        $this->deleted = $deleted;
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
     * @return Problem
     */
    public function setCreatedAt(\DateTime $createdAt): Problem
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
     * @return Problem
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Problem
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}