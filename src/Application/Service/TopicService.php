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
		$parentTopics    = [
			new Topic( 'Framework' ),
			new Topic( 'Language' ),
			new Topic( 'Technology' )
		];
		$language        = function ( $name, $description = null, $example = null ) {
			return new Topic( $name, 'Language', $description, $example );
		};
		$languageTopics  = [
			$language( 'PHP' ),
			$language( 'HTML' ),
			$language( 'JS' ),
			$language( 'Python' ),
			$language( 'CSS' ),
			$language( 'Shell' ),
			$language( 'Swift' ),
			$language( 'Go' ),
			$language( 'C#' ),
			$language( 'C' ),
			$language( 'Objective-C' ),
			$language( 'Docker Compose' ),
			$language( 'Docker File' ),
			$language( 'Java' ),
			$language( 'SCSS' ),
			$language( 'SASS' ),
			$language( 'LESS' )
		];
		$framework       = function ( $name, $description = null, $example = null ) {
			return new Topic( $name, 'Framework', $description, $example );
		};
		$frameworkTopics = [
			$framework( 'Laravel', 'PHP Framework' ),
			$framework( 'Code Igniter', 'PHP Framework' ),
			$framework( 'Zend', 'PHP Framework' ),
			$framework( 'React', 'JS Framework' ),
			$framework( 'Vue', 'JS Framework' ),
			$framework( 'Word Press', 'PHP Framework' )
		];
		$tech            = function ( $name, $description = null, $example = null ) {
			return new Topic( $name, 'Technology', $description, $example );
		};
		$techTopics      = [
			$tech( 'Kubernetes', 'Container Orchestration' ),
			$tech( 'Docker Swarm', 'Container Orchestration' ),
			$tech( 'Docker', 'Container' ),
			$tech( 'Apache', 'Server Technologies' ),
			$tech( 'Nginx', 'PHP Framework' ),
			$tech( 'Web Sockets', 'Protocol' ),
			$tech( 'TCP', 'Protocol' ),
			$tech( 'SSL', 'Security Protocol' ),
			$tech( 'Swoole', 'Server Technologies' ),
			$tech( 'System Administration', 'Taking care of Server Technologies' ),
			$tech( 'Ansible', 'Server Orchestration' ),
		];

		static::$topics = array_merge( $parentTopics, $languageTopics, $frameworkTopics, $techTopics );
	}

	/**
	 * @param $name
	 *
	 * @return Topic
	 */
	public static function getTopicByName( string $name ): Topic {
		foreach ( static::getTopics() as &$topic ) {
			if ( $topic->getName() == $name ) {
				return $topic;
			}
		}

	}

	/**
	 * @param string $topicId
	 *
	 * @return Topic
	 */
	public static function getTopic( string $topicId ): Topic {
		foreach ( static::getTopics() as &$topic ) {
			if ( $topic->getId() == $topicId ) {
				return $topic;
			}
		}

	}

	/**
	 * @param $topicId
	 *
	 * @return Topic
	 */
	public function read( $topicId ): Topic {
		return static::getTopic( $topicId );
	}

}