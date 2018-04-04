<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Kudos
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Uuid
     */
    private $toUserId;

    /**
     * @var Uuid
     */
    private $fromUserId;

    /**
     * @var Uuid
     */
    private $fromOrganisationId;

    /**
     * @var string
     */
    private $reasonType;

    /**
     * @var Uuid
     */
    private $reasonId;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * Kudos constructor.
     * @param Uuid $id
     * @param Uuid $toUserId
     * @param Uuid $fromUserId
     * @param Uuid $fromOrganisationId
     * @param string $reasonType
     * @param Uuid $reasonId
     * @param int $amount
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $toUserId,
        Uuid $fromUserId,
        Uuid $fromOrganisationId,
        string $reasonType,
        Uuid $reasonId,
        int $amount,
        \DateTime $createdAt,
        ?\DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->toUserId = $toUserId;
        $this->fromUserId = $fromUserId;
        $this->fromOrganisationId = $fromOrganisationId;
        $this->reasonType = $reasonType;
        $this->reasonId = $reasonId;
        $this->amount = $amount;
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
     * @return Kudos
     */
    public function setId(Uuid $id): Kudos
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getToUserId(): Uuid
    {
        return $this->toUserId;
    }

    /**
     * @param Uuid $toUserId
     * @return Kudos
     */
    public function setToUserId(Uuid $toUserId): Kudos
    {
        $this->toUserId = $toUserId;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getFromUserId(): Uuid
    {
        return $this->fromUserId;
    }

    /**
     * @param Uuid $fromUserId
     * @return Kudos
     */
    public function setFromUserId(Uuid $fromUserId): Kudos
    {
        $this->fromUserId = $fromUserId;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getFromOrganisationId(): Uuid
    {
        return $this->fromOrganisationId;
    }

    /**
     * @param Uuid $fromOrganisationId
     * @return Kudos
     */
    public function setFromOrganisationId(Uuid $fromOrganisationId): Kudos
    {
        $this->fromOrganisationId = $fromOrganisationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReasonType(): string
    {
        return $this->reasonType;
    }

    /**
     * @param string $reasonType
     * @return Kudos
     */
    public function setReasonType(string $reasonType): Kudos
    {
        $this->reasonType = $reasonType;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getReasonId(): Uuid
    {
        return $this->reasonId;
    }

    /**
     * @param Uuid $reasonId
     * @return Kudos
     */
    public function setReasonId(Uuid $reasonId): Kudos
    {
        $this->reasonId = $reasonId;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Kudos
     */
    public function setAmount(int $amount): Kudos
    {
        $this->amount = $amount;
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
     * @return Kudos
     */
    public function setCreatedAt(\DateTime $createdAt): Kudos
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
     * @return Kudos
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Kudos
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}