<?php

namespace DevPledge\Domain;


use DevPledge\Application\Mapper\Mappable;

/**
 * Class Topic
 * @package DevPledge\Domain
 */
class Topic implements Mappable {

	protected $name;
	protected $parentName;
	protected $description;
	protected $example;

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
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'name'        => $this->name,
			'parent_name' => $this->parentName,
			'description' => $this->description,
			'example'     => $this->example
		];
	}
}