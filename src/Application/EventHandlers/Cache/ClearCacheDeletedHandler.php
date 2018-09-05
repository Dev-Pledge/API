<?php

namespace DevPledge\Application\EventHandlers\Cache;


use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Integrations\Event\AbstractEventHandler;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;

/**
 * Class ClearCacheDeletedHandler
 * @package DevPledge\Application\EventHandlers\Cache
 */
class ClearCacheDeletedHandler extends AbstractEventHandler {
	/**
	 * ClearCacheDeletedHandler constructor.
	 */
	public function __construct() {
		parent::__construct( DeletedDomainEvent::class );
	}

	/**
	 * @param $event UpdatedDomainEvent
	 */
	protected function handle( $event ) {
		$domain = $event->getDomain();
		if ( $domain instanceof Comment ) {
			$commentService = CommentServiceProvider::getService();
			$keys           = [];
			$keys[]         = $commentService->getAllCommentsKey( $domain->getEntityId() );
			$keys[]         = $commentService->getAllRepliesKey( $domain->getParentCommentId() );
			$keys[]         = $commentService->getLastFiveCommentKey( $domain->getEntityId() );
			$keys[]         = $commentService->getLastFiveReplyKey( $domain->getParentCommentId() );
			CacheServiceProvider::getService()->deleteKeys( $keys );

		}
	}
}