<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Count;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;

/**
 * Class FetchCommentCount
 * @package DevPledge\Domain\Fetcher
 */
class FetchCommentCount extends Count {
	/**
	 * FetchCommentCount constructor.
	 *
	 * @param string $entityId
	 */
	public function __construct( string $entityId ) {

		try {
			$commentService = CommentServiceProvider::getService();
			$count          = $commentService->countComments( $entityId );
			parent::__construct( $count );
		} catch ( \Exception | \TypeError $exception ) {
			parent::__construct( 0 );
			Sentry::get()->captureException( $exception );
		}

	}
}