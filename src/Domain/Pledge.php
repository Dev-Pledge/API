<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

class Pledge
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
     * @var Uuid
     */
    private $problemId;

    /**
     * @var int
     */
    private $kudos_points;

    /**
     * @var float
     */
    private $value;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * Pledge constructor.
     * @param Uuid $id
     * @param Uuid $userId
     * @param Uuid $organisationId
     * @param Uuid $problemId
     * @param int $kudos_points
     * @param float $value
     * @param Currency $currency
     * @param string $comment
     * @param \DateTime $createdAt
     * @param \DateTime|null $updatedAt
     */
    public function __construct(
        Uuid $id,
        Uuid $userId,
        Uuid $organisationId,
        Uuid $problemId,
        int $kudos_points,
        float $value,
        Currency $currency,
        string $comment,
        \DateTime $createdAt,
        ?\DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->organisationId = $organisationId;
        $this->problemId = $problemId;
        $this->kudos_points = $kudos_points;
        $this->value = $value;
        $this->currency = $currency;
        $this->comment = $comment;
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
     * @return Pledge
     */
    public function setId(Uuid $id): Pledge
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
     * @return Pledge
     */
    public function setUserId(Uuid $userId): Pledge
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
     * @return Pledge
     */
    public function setOrganisationId(Uuid $organisationId): Pledge
    {
        $this->organisationId = $organisationId;
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
     * @return Pledge
     */
    public function setProblemId(Uuid $problemId): Pledge
    {
        $this->problemId = $problemId;
        return $this;
    }

    /**
     * @return int
     */
    public function getKudosPoints(): int
    {
        return $this->kudos_points;
    }

    /**
     * @param int $kudos_points
     * @return Pledge
     */
    public function setKudosPoints(int $kudos_points): Pledge
    {
        $this->kudos_points = $kudos_points;
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
     * @return Pledge
     */
    public function setValue(float $value): Pledge
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
     * @return Pledge
     */
    public function setCurrency(Currency $currency): Pledge
    {
        $this->currency = $currency;
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
     * @return Pledge
     */
    public function setComment(string $comment): Pledge
    {
        $this->comment = $comment;
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
     * @return Pledge
     */
    public function setCreatedAt(\DateTime $createdAt): Pledge
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
     * @return Pledge
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Pledge
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}