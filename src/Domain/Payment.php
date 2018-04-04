<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Payment
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
    private $solutionId;

    /**
     * @var Uuid
     */
    private $fromUserId;

    /**
     * @var Uuid
     */
    private $fromOrganisationId;

    /**
     * @var float
     */
    private $value;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var \DateTime|null
     */
    private $paidAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * Payment constructor.
     * @param Uuid $id
     * @param Uuid $toUserId
     * @param Uuid $solutionId
     * @param Uuid $fromUserId
     * @param Uuid $fromOrganisationId
     * @param float $value
     * @param Currency $currency
     * @param \DateTime|null $paidAt
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $toUserId,
        Uuid $solutionId,
        Uuid $fromUserId,
        Uuid $fromOrganisationId,
        float $value,
        Currency $currency,
        ?\DateTime $paidAt,
        \DateTime $createdAt,
        ?\DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->toUserId = $toUserId;
        $this->solutionId = $solutionId;
        $this->fromUserId = $fromUserId;
        $this->fromOrganisationId = $fromOrganisationId;
        $this->value = $value;
        $this->currency = $currency;
        $this->paidAt = $paidAt;
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
     * @return Payment
     */
    public function setId(Uuid $id): Payment
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
     * @return Payment
     */
    public function setToUserId(Uuid $toUserId): Payment
    {
        $this->toUserId = $toUserId;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getSolutionId(): Uuid
    {
        return $this->solutionId;
    }

    /**
     * @param Uuid $solutionId
     * @return Payment
     */
    public function setSolutionId(Uuid $solutionId): Payment
    {
        $this->solutionId = $solutionId;
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
     * @return Payment
     */
    public function setFromUserId(Uuid $fromUserId): Payment
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
     * @return Payment
     */
    public function setFromOrganisationId(Uuid $fromOrganisationId): Payment
    {
        $this->fromOrganisationId = $fromOrganisationId;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Payment
     */
    public function setValue(float $value): Payment
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     * @return Payment
     */
    public function setCurrency(Currency $currency): Payment
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPaidAt(): ?\DateTime
    {
        return $this->paidAt;
    }

    /**
     * @param \DateTime|null $paidAt
     * @return Payment
     */
    public function setPaidAt(?\DateTime $paidAt): Payment
    {
        $this->paidAt = $paidAt;
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
     * @return Payment
     */
    public function setCreatedAt(\DateTime $createdAt): Payment
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
     * @return Payment
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Payment
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        return ! is_null($this->getPaidAt());
    }
}