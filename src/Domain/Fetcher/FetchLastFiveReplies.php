<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 04/09/2018
 * Time: 20:03
 */

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Comments;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchReplies
 * @package DevPledge\Domain\Fetcher
 */
class FetchLastFiveReplies extends Comments {
	/**
	 * FetchReplies constructor.
	 *
	 * @param $commentId
	 */
	public function __construct( $commentId ) {
		try {

			$commentService = CommentServiceProvider::getService();
			$comments       = $commentService->readLastFiveReplies( $commentId );
			parent::__construct( $comments->getComments() );
		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
			parent::__construct( [] );
		}

	}
}