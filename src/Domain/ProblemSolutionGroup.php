<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class ProblemSolutionGroup
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Uuid
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
     * @param Uuid $problemId
     * @param string $name
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(Uuid $id, Uuid $problemId, string $name, \DateTime $createdAt, ?\DateTime $updatedAt)
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
     * @return ProblemSolutionGroup
     */
    public function setId(Uuid $id): ProblemSolutionGroup
    {
        $this->id = $id;
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
     * @return ProblemSolutionGroup
     */
    public function setProblemId(Uuid $problemId): ProblemSolutionGroup
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
     * @return ProblemSolutionGroup
     */
    public function setName(string $name): ProblemSolutionGroup
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
     * @return ProblemSolutionGroup
     */
    public function setCreatedAt(\DateTime $createdAt): ProblemSolutionGroup
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
     * @return ProblemSolutionGroup
     */
    public function setUpdatedAt(?\DateTime $updatedAt): ProblemSolutionGroup
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}