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
     */
    public function setId(Uuid $id): void
    {
        $this->id = $id;
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
     */
    public function setUserId(Uuid $userId): void
    {
        $this->userId = $userId;
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
     */
    public function setOrganisationId(Uuid $organisationId): void
    {
        $this->organisationId = $organisationId;
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
     */
    public function setSpecification(string $specification): void
    {
        $this->specification = $specification;
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
     */
    public function setLastActive(\DateTime $lastActive): void
    {
        $this->lastActive = $lastActive;
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
     */
    public function setDeadline(?\DateTime $deadline): void
    {
        $this->deadline = $deadline;
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
     */
    public function setRepo(?Repo $repo): void
    {
        $this->repo = $repo;
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
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
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
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
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
     */
    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}