<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Count;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;

/**
 * Class FetchRepliesCount
 * @package DevPledge\Domain\Fetcher
 */
class FetchRepliesCount extends Count {
	/**
	 * FetchCommentCount constructor.
	 *
	 * @param string $entityId
	 */
	public function __construct( string $commentId ) {

		try {

			$commentService = CommentServiceProvider::getService();
			$count          = $commentService->countReplies( $commentId );
			parent::__construct( $count );
		} catch ( \Exception | \TypeError $exception ) {
			parent::__construct( 0 );
			Sentry::get()->captureException( $exception );
		}

	}
}