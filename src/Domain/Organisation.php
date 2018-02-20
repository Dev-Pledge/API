<?php

namespace DevPledge\Domain;


class Organisation
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var User[]
     */
    private $user;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
     * @return Organisation
     */
    public function setName(string $name): Organisation
    {
	    /**
	     * @var $org Organisation
	     */
	    $org->getUser();
        $this->name = $name;
        return $this;
    }

	/**
	 * @return User
	 */
	public function getUser():User {
		return $this->user;
	}


}