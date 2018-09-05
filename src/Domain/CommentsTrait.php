<?php

namespace DevPledge\Domain;

use DevPledge\Integrations\Sentry;

/**
 * Trait CommentsTrait
 * @package DevPledge\Domain
 */
trait CommentsTrait {

	/**
	 * @var Comments
	 */
	protected $lastFiveComments;
	/**
	 * @var Count
	 */
	protected $totalComments;

	/**
	 * @param Comments $lastFiveComments
	 *
	 * @return CommentsTrait
	 */
	public function setLastFiveComments( Comments $lastFiveComments ) {
		$this->lastFiveComments = $lastFiveComments;

		return $this;
	}

	/**
	 * @return Comments
	 * @throws \Exception
	 */
	public function getLastFiveComments(): Comments {
		return isset( $this->lastFiveComments ) ? $this->lastFiveComments : new Comments( [] );
	}

	/**
	 * @param Count $totalComments
	 *
	 * @return CommentsTrait
	 */
	public function setTotalComments( Count $totalComments ) {
		$this->totalComments = $totalComments;

		return $this;
	}

	/**
	 * @return Count
	 */
	public function getTotalComments(): Count {
		return isset( $this->totalComments ) ? $this->totalComments : new Count( 0 );
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return \stdClass
	 * @throws \Exception
	 */
	protected function appendCommentDataToAPIData( \stdClass &$data ): \stdClass {
		try {
			$data->last_five_comments = $this->getLastFiveComments()->toAPIMapArray();
			$data->total_comments     = $this->getTotalComments()->getCount();
		} catch ( \TypeError|\Exception $exception ) {
			Sentry::get()->captureException( $exception );
			$data->last_five_comments = [];
			$data->total_comments     = 0;
		}

		return $data;
	}

	/**
	 * @return \stdClass
	 * @throws \Exception
	 */
	public function toAPIMapWithComments(): \stdClass {
		$data = clone( $this->toPublicAPIMap() );

		return $this->appendCommentDataToAPIData( $data );
	}


}