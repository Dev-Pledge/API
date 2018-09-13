<?php

namespace DevPledge\Domain;

/**
 * Class StatusComment
 * @package DevPledge\Domain
 */
class StatusComment extends Comment {

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

}