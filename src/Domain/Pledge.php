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
     * @return int
     */
    public function getKudosPoints(): int
    {
        return $this->kudos_points;
    }

    /**
     * @param int $kudos_points
     */
    public function setKudosPoints(int $kudos_points): void
    {
        $this->kudos_points = $kudos_points;
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
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
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
     */
    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
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