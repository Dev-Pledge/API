<?php

namespace DevPledge\Domain;


use DevPledge\Application\Service\TopicService;

/**
 * Class Topics
 * @package DevPledge\Domain
 */
class Topics extends AbstractDomain {
	/**
	 * @var Topic[]
	 */
	protected $topics = [];

	/**
	 * Topics constructor.
	 *
	 * @param array $topics
	 */
	public function __construct( array $topics ) {

		if ( $topics ) {

			foreach ( $topics as &$topic ) {
				if ( ! ( $topic instanceof Topic ) ) {
					$topic = TopicService::getTopicByName( $topic );

				}
			}

			$this->topics = $topics;
		}

	}

	/**
	 * @return array
	 */
	public function toArray() {

		$returnArray = [];
		if ( $topics = $this->topics ) {
			foreach ( $topics as $topic ) {
				if ( $topic instanceof Topic ) {
					$returnArray[] = $topic->getName();
				}
			}
		}

		return $returnArray;
	}

	/**
	 * @return array|Topic[]
	 */
	public function getTopics() {
		return $this->topics;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) $this->getTopics();
	}

	/**
	 * @return array
	 */
	function toAPIMapArray(): array {
		$returnArray = [];

		$topics = $this->getTopics();
		foreach ( $topics as $topic ) {
			$returnArray[] = $topic->toAPIMap();
		}

		return $returnArray;
	}
}