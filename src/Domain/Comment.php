<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Comment
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
     * @var string
     */
    private $type;

    /**
     * @var Uuid
     */
    private $onId;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var Uuid|null
     */
    private $parentId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Comment constructor.
     * @param Uuid $id
     * @param Uuid $userId
     * @param string $type
     * @param Uuid $onId
     * @param string $comment
     * @param Uuid|null $parentId
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $userId,
        string $type,
        Uuid $onId,
        string $comment,
        ?Uuid $parentId,
        \DateTime $createdAt,
        \DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->onId = $onId;
        $this->comment = $comment;
        $this->parentId = $parentId;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Uuid
     */
    public function getOnId(): Uuid
    {
        return $this->onId;
    }

    /**
     * @param Uuid $onId
     */
    public function setOnId(Uuid $onId): void
    {
        $this->onId = $onId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return Uuid|null
     */
    public function getParentId(): ?Uuid
    {
        return $this->parentId;
    }

    /**
     * @param Uuid|null $parentId
     */
    public function setParentId(?Uuid $parentId): void
    {
        $this->parentId = $parentId;
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
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}