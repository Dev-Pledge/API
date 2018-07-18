<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 18/07/2018
 * Time: 21:41
 */

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
		$this->setUpTopics();

		return static::$topics;
	}

	protected function setUpTopics() {
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

	public function mapTopicToProblem(Problem $problem, array $topics){

	}

}