<?php

namespace DevPledge\Application\EventHandlers\Cache;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Domain\Comment;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Event\AbstractEventHandler;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;

/**
 * Class ClearCacheCommentCreatedHandler
 * @package DevPledge\Application\EventHandlers\CommunicationCache
 */
class ClearCacheCreatedHandler extends AbstractEventHandler {
	/**
	 * ClearCacheCreatedHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreatedDomainEvent::class );
	}

	/**
	 * @param $event CreatedDomainEvent
	 */
	protected function handle( $event ) {
		$domain = $event->getDomain();
		if ( $domain instanceof Comment ) {
			$commentService = CommentServiceProvider::getService();
			$keys           = [];
			$keys[]         = $commentService->getAllCommentsKey( $domain->getEntityId() );
			$keys[]         = $commentService->getLastFiveCommentKey( $domain->getEntityId() );
			if ( ! is_null( $domain->getParentCommentId() ) ) {
				$keys[] = $commentService->getAllRepliesKey( $domain->getParentCommentId() );
			}
			if ( ! is_null( $domain->getParentCommentId() ) ) {
				$keys[] = $commentService->getLastFiveReplyKey( $domain->getParentCommentId() );
			}

			CacheServiceProvider::getService()->deleteKeys( $keys );

		}

	}
}