<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Topic;
use DevPledge\Framework\ServiceProviders\TopicServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchTopic
 * @package DevPledge\Domain\Fetcher
 */
class FetchTopic extends Topic {
	/**
	 * FetchTopic constructor.
	 *
	 * @param $topicId
	 */
	public function __construct( $topicId ) {

		try {
			$topicService = TopicServiceProvider::getService();
			$topic        = $topicService->read( $topicId );
			parent::__construct(
				$topic->getName(), $topic->getParentName(), $topic->getDescription(), $topic->getExample()
			);
		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
		}
	}
}