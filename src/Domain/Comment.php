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
     * @return Comment
     */
    public function setId(Uuid $id): Comment
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
     * @return Comment
     */
    public function setUserId(Uuid $userId): Comment
    {
        $this->userId = $userId;
        return $this;
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
     * @return Comment
     */
    public function setType(string $type): Comment
    {
        $this->type = $type;
        return $this;
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
     * @return Comment
     */
    public function setOnId(Uuid $onId): Comment
    {
        $this->onId = $onId;
        return $this;
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
     * @return Comment
     */
    public function setComment(string $comment): Comment
    {
        $this->comment = $comment;
        return $this;
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
     * @return Comment
     */
    public function setParentId(?Uuid $parentId): Comment
    {
        $this->parentId = $parentId;
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
     * @return Comment
     */
    public function setCreatedAt(\DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
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
     * @return Comment
     */
    public function setUpdatedAt(\DateTime $updatedAt): Comment
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}