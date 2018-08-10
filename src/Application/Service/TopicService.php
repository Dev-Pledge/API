<?php

namespace DevPledge\Application\Service;


use DevPledge\Domain\Problem;
use DevPledge\Domain\Topic;

/**
 * Class TopicService
 * @package DevPledge\Application\Service
 */
class TopicService {
	/**
	 * @var Topic[]
	 */
	protected static $topics;

	/**
	 * @return Topic[]
	 */
	public function getTopics() {
		if ( isset( static::$topics ) ) {
			return static::$topics;
		}
		static::setUpTopics();

		return static::$topics;
	}

	static protected function setUpTopics() {
		$parentTopics   = [
			new Topic( 'Framework' ),
			new Topic( 'Language' ),
			new Topic( 'Docker' )
		];
		$language       = function ( $name, $description = null, $example = null ) {
			return new Topic( $name, 'Language', $description, $example );
		};
		$languageTopics = [
			$language( 'PHP' ),
			$language( 'HTML' ),
			$language( 'JS' ),
			$language( 'Python' ),
			$language( 'CSS' ),
			$language( 'Shell' ),
			$language( 'Swift' ),
			$language( 'Go' ),
			$language( 'SCSS' ),
			$language( 'SASS' ),
			$language( 'LESS' )
		];
		static::$topics = array_merge( $parentTopics, $languageTopics );
	}

	/**
	 * @param $name
	 *
	 * @return Topic
	 */
	public static function getTopic( $name ) {
		foreach ( static::getTopics() as &$topic ) {
			if ( $topic->getName() == $name ) {
				return $topic;
			}
		}
	}

}