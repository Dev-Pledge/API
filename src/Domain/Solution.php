<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Solution
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
    private $solutionGroupId;

    /**
     * @var Uuid
     */
    private $problemSolutionGroupId;

    /**
     * @var Uuid
     */
    private $problemId;

    /**
     * @var Repo
     */
    private $repo;

    /**
     * @var \DateTime
     */
    private $lastActive;

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
     * Solution constructor.
     * @param Uuid $id
     * @param Uuid $userId
     * @param Uuid $solutionGroupId
     * @param Uuid $problemSolutionGroupId
     * @param Uuid $problemId
     * @param Repo $repo
     * @param \DateTime $lastActive
     * @param bool $deleted
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $userId,
        Uuid $solutionGroupId,
        Uuid $problemSolutionGroupId,
        Uuid $problemId,
        Repo $repo,
        \DateTime $lastActive,
        bool $deleted = false,
        \DateTime $createdAt,
        ?\DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->solutionGroupId = $solutionGroupId;
        $this->problemSolutionGroupId = $problemSolutionGroupId;
        $this->problemId = $problemId;
        $this->repo = $repo;
        $this->lastActive = $lastActive;
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
    public function getSolutionGroupId(): Uuid
    {
        return $this->solutionGroupId;
    }

    /**
     * @param Uuid $solutionGroupId
     */
    public function setSolutionGroupId(Uuid $solutionGroupId): void
    {
        $this->solutionGroupId = $solutionGroupId;
    }

    /**
     * @return Uuid
     */
    public function getProblemSolutionGroupId(): Uuid
    {
        return $this->problemSolutionGroupId;
    }

    /**
     * @param Uuid $problemSolutionGroupId
     */
    public function setProblemSolutionGroupId(Uuid $problemSolutionGroupId): void
    {
        $this->problemSolutionGroupId = $problemSolutionGroupId;
    }

    /**
     * @return Uuid
     */
    public function getProblemId(): Uuid
    {
        return $this->problemId;
    }

    /**
     * @param Uuid $problemId
     */
    public function setProblemId(Uuid $problemId): void
    {
        $this->problemId = $problemId;
    }

    /**
     * @return Repo
     */
    public function getRepo(): Repo
    {
        return $this->repo;
    }

    /**
     * @param Repo $repo
     */
    public function setRepo(Repo $repo): void
    {
        $this->repo = $repo;
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