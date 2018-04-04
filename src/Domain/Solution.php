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
     * @return Solution
     */
    public function setId(Uuid $id): Solution
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
     * @return Solution
     */
    public function setUserId(Uuid $userId): Solution
    {
        $this->userId = $userId;
        return $this;
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
     * @return Solution
     */
    public function setSolutionGroupId(Uuid $solutionGroupId): Solution
    {
        $this->solutionGroupId = $solutionGroupId;
        return $this;
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
     * @return Solution
     */
    public function setProblemSolutionGroupId(Uuid $problemSolutionGroupId): Solution
    {
        $this->problemSolutionGroupId = $problemSolutionGroupId;
        return $this;
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
     * @return Solution
     */
    public function setProblemId(Uuid $problemId): Solution
    {
        $this->problemId = $problemId;
        return $this;
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
     * @return Solution
     */
    public function setRepo(Repo $repo): Solution
    {
        $this->repo = $repo;
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
     * @return Solution
     */
    public function setLastActive(\DateTime $lastActive): Solution
    {
        $this->lastActive = $lastActive;
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
     * @return Solution
     */
    public function setDeleted(bool $deleted): Solution
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
     * @return Solution
     */
    public function setCreatedAt(\DateTime $createdAt): Solution
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
     * @return Solution
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Solution
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}