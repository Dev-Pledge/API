<?php

namespace DevPledge\Domain;


use DevPledge\Uuid\Uuid;

abstract class Repo
{
    /**
     * @var string
     */
    protected static $baseUrl;

    /**
     * @var Uuid
     */
    private $id;

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
     * User constructor.
     * @param Uuid $id
     * @param string $name
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(Uuid $id, string $name, \DateTime $createdAt, ?\DateTime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public static function getBaseUrl(): string
    {
        return self::$baseUrl;
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
     * @return Repo
     */
    public function setId(Uuid $id): Repo
    {
        $this->id = $id;
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
     * @return Repo
     */
    public function setName(string $name): Repo
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
     * @return Repo
     */
    public function setCreatedAt(\DateTime $createdAt): Repo
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
     * @return Repo
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Repo
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}