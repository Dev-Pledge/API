<?php

namespace DevPledge\Domain;


use DevPledge\Application\Mapper\Mappable;
use DevPledge\Uuid\Uuid;

/**
 * Class AbstractDomain
 * @package DevPledge\Domain
 */
abstract class AbstractDomain implements Mappable {
	/**
	 * @var Uuid
	 */
	protected $uuid;
	/**
	 * @var string
	 */
	protected $entity;
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var \DateTime
	 */
	protected $created;
	/**
	 * @var \DateTime
	 */
	protected $modified;
	/**
	 * @var bool
	 */
	protected $persistedDataFound = false;

	public function __construct( string $entity ) {
		$this->entity = $entity;
	}

	/**
	 * @return null|Uuid
	 */
	public function getUuid(): Uuid {
		return $this->uuid = $this->uuid ?? Uuid::make( $this->entity );
	}

	/**
	 * @param Uuid $uuid
	 *
	 * @return $this
	 */
	public function setUuid( Uuid $uuid ) {

		$this->uuid = $uuid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->getUuid()->toString();
	}

	/**
	 * @return Data
	 */
	public function getData(): Data {
		return isset( $this->data ) ? $this->data : new Data();
	}

	/**
	 * @param Data $data
	 *
	 * @return User
	 */
	public function setData( Data $data ): User {
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
	 * @return bool
	 */
	public function isPersistedDataFound(): bool {
		return $this->persistedDataFound;
	}

	/**
	 * @param bool $dataFound
	 *
	 * @return $this
	 */
	public function setPersistedDataFound( bool $dataFound ) {
		$this->persistedDataFound = $dataFound;

		return $this;
	}

	/**
	 * @param \DateTime|null $dateTime
	 * @param string $format
	 *
	 * @return null|string
	 */
	protected function dateTimeStringOrNull( \DateTime $dateTime = null, $format = 'Y-m-d H:i:s' ) {
		if ( ! isset( $dateTime ) ) {
			return null;
		}

		return $dateTime->format( $format );
	}

	protected function boolAsTinyInt( $bool ) {
		return $bool ? 1 : 0;
	}

}