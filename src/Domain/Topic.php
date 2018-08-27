<?php

namespace DevPledge\Domain;


use DevPledge\Application\Mapper\PersistMappable;
use DevPledge\Uuid\TopicUuid;


/**
 * Class Topic
 * @package DevPledge\Domain
 */
class Topic implements PersistMappable {

	protected $name;
	protected $parentName;
	protected $description;
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
		$this->uuid        = new TopicUuid( $name  );
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
}