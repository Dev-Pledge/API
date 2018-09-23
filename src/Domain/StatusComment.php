<?php

namespace DevPledge\Domain;

use DevPledge\Integrations\Route\Example;

/**
 * Class StatusComment
 * @package DevPledge\Domain
 */
class StatusComment extends Comment implements Example {

	use CommentsTrait;

	/**
	 * @return \stdClass
	 * @throws \Exception
	 */
	public function toAPIMap(): \stdClass {
		$data = parent::toAPIMap();
		/**
		 * For UI to easily get corresponding UUID
		 */
		$data->status_id = $this->getId();
		$this->appendCommentDataToAPIData( $data );
		$data->user   = $this->getUser()->toPublicAPIMap();
		$data->topics = $this->getTopics()->toArray();
		unset( $data->last_five_replies );
		unset( $data->total_replies );

		return $data;
	}

	public static function getExampleInstance() {
		static $example;
		if ( ! isset( $example ) ) {
			$example = new static( 'status' );
			$example->setEntityId( Problem::getExampleInstance()->getId() )
			        ->setUser( User::getExampleInstance() )
			        ->setUserId( User::getExampleInstance()->getId() )
			        ->setComment( new UserDefinedContent( 'My awesome comment about php vs python! http://www.google.com link to stuff' ) )
			        ->setTopics( new Topics( [ 'PHP', 'Python' ] ) );
		}

		return $example;
	}

	public static function getExampleRequest(): ?\Closure {
		return function () {
			return (object) [
				'comment' => 'My awesome comment about php vs python! http://www.google.com link to stuff',
				'topics'  => [ 'PHP', 'Python' ]
			];
		};
	}


}