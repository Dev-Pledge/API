<?php

namespace DevPledge\Domain;

use DevPledge\Application\Mapper\Mappable;
use DevPledge\Domain\PreferredUserAuth\UsernameEmailPassword;
use DevPledge\Uuid\Uuid;


/**
 * Class User
 * @package DevPledge\Domain
 */
class User implements Mappable {

	/**
	 * @var Uuid
	 */
	private $id;
	/**
	 * @var string | null
	 */
	private $email;
	/**
	 * @var int | null
	 */
	private $gitHubId;
	/**
	 * @var string | null
	 */
	private $hashedPassword;
	/**
	 * @var bool
	 */
	private $developer;
	/**
	 * @var string
	 */
	private $username;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var \stdClass
	 */
	private $data;
	/**
	 * @var \DateTime
	 */
	private $created;
	/**
	 * @var \DateTime
	 */
	private $modified;


	/**
	 * @param Uuid $id
	 *
	 * @return User
	 */
	public function setId( Uuid $id ): User {
		$this->id = $id;

		return $this;
	}

	/**
	 * @param string $email
	 *
	 * @return User
	 */
	public function setEmail( string $email ): User {
		$this->email = $email;

		return $this;
	}

	/**
	 * @param string $hashedPassword
	 *
	 * @return User
	 */
	public function setHashedPassword( string $hashedPassword ): User {
		$this->hashedPassword = $hashedPassword;

		return $this;
	}

	/**
	 * @return null|Uuid
	 */
	public function getId(): ?Uuid {
		return $this->id;
	}

	/**
	 * @return null|string
	 */
	public function getEmail(): ?string {
		return $this->email;
	}

	/**
	 * @return UsernameEmailPassword
	 */
	public function getEmailPasswordAuth() {
		return new UsernameEmailPassword( $this->getEmail(), null, $this->getHashedPassword() );
	}

	/**
	 * @return null|string
	 */
	public function getHashedPassword(): ?string {
		return $this->hashedPassword;
	}

	/**
	 * @param bool $developer
	 *
	 * @return User
	 */
	public function setDeveloper( bool $developer ): User {
		$this->developer = $developer;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDeveloper(): bool {
		return isset( $this->developer ) ? $this->developer : false;
	}

	/**
	 * @param string $name
	 *
	 * @return User
	 */
	public function setName( string $name ): User {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param string $name
	 *
	 * @return User
	 */
	public function setUsername( string $username ): User {
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return isset( $this->data ) ? $this->data : new \stdClass();
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return User
	 */
	public function setData( \stdClass $data ): User {
		$this->data = $data;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreated(): \DateTime {
		return isset( $this->created ) ? $this->created : new \DateTime();
	}

	/**
	 * @param \DateTime $created
	 *
	 * @return User
	 */
	public function setCreated( \DateTime $created ): User {
		$this->created = $created;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getModified(): \DateTime {
		return isset( $this->modified ) ? $this->modified : new \DateTime();
	}

	/**
	 * @param \DateTime $modified
	 *
	 * @return User
	 */
	public function setModified( \DateTime $modified ): User {
		$this->modified = $modified;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getGitHubId(): ?int {
		return $this->gitHubId;
	}

	/**
	 * @param int|null $gitHubId
	 *
	 * @return User
	 */
	public function setGitHubId( ?int $gitHubId ): User {
		$this->gitHubId = $gitHubId;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toMap(): \stdClass {

		return (object) [
			'user_id'         => $this->getId()->toString(),
			'name'            => $this->getName(),
			'username'        => $this->getUsername(),
			'modified'        => $this->getModified()->format( 'Y-m-d H:i:s' ),
			'created'         => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'hashed_password' => $this->getHashedPassword()
		];
	}
}