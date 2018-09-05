<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Comments;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchComments
 * @package DevPledge\Domain\Fetcher
 */
class FetchLastFiveComments extends Comments {
	/**
	 * FetchComments constructor.
	 *
	 * @param $entityId
	 */
	public function __construct( $entityId ) {
		try {
			$commentService = CommentServiceProvider::getService();
			$comments       = $commentService->readLastFiveComments( $entityId );
			parent::__construct( $comments->getComments() );
		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
		}
	}
}