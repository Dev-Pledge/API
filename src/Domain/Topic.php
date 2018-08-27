<?php

namespace DevPledge\Domain;


use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Uuid\TopicUuid;


/**
 * Class Topic
 * @package DevPledge\Domain
 */
class Topic implements PersistMappable {
	/**
	 * @var string
	 */
	protected $name;
	/**
	 * @var null | string
	 */
	protected $parentName;
	/**
	 * @var null | string
	 */
	protected $description;
	/**
	 * @var null | string
	 */
	protected $example;
	/**
	 * @var TopicUuid
	 */
	protected $uuid;

	/**
	 * Topic constructor.
	 *
	 * @param $name
	 * @param null $parentName
	 * @param null $description
	 * @param null $example
	 */
	public function __construct( $name, $parentName = null, $description = null, $example = null ) {
		$this->name        = $name;
		$this->parentName  = $parentName;
		$this->description = $description;
		$this->example     = $example;
		$this->uuid        = new TopicUuid( $name );
	}

	/**
	 * @return TopicUuid
	 */
	public function getUuid(): TopicUuid {
		return $this->uuid;
	}

	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->getUuid()->toString();
	}

	/**
	 * @return \stdClass
	 */
	public function toPersistMap(): \stdClass {
		return (object) [
			'topic_id'    => $this->getId(),
			'name'        => $this->name,
			'parent_name' => $this->parentName,
			'description' => $this->description,
			'example'     => $this->example
		];
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * @return null | string
	 */
	public function getParentName(): ?string {
		return $this->parentName;
	}

	/**
	 * @return array
	 */
	function toPersistMapArray(): array {
		return (array) $this->toPersistMap();
	}

	/**
	 * @return \stdClass
	 */
	function toAPIMap(): \stdClass {
		return $this->toPersistMap();
	}

	/**
	 * @return array
	 */
	function toAPIMapArray(): array {
		return (array) $this->toPersistMap();
	}

	/**
	 * @param string $name
	 *
	 * @return Topic
	 */
	public function setName( string $name ): Topic {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param null|string $parentName
	 *
	 * @return Topic
	 */
	public function setParentName( ?string $parentName ): Topic {
		$this->parentName = $parentName;

		return $this;
	}

	/**
	 * @param null|string $description
	 *
	 * @return Topic
	 */
	public function setDescription( ?string $description ): Topic {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getExample(): ?string {
		return $this->example;
	}

	/**
	 * @param null|string $example
	 *
	 * @return Topic
	 */
	public function setExample( ?string $example ): Topic {
		$this->example = $example;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getDescription(): ?string {
		return $this->description;
	}
}