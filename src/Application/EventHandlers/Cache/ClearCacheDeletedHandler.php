<?php

namespace DevPledge\Application\EventHandlers\Cache;


use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Framework\ServiceProviders\CommentServiceProvider;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
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
			$keys[] = $commentService->getLastFiveCommentKey( $domain->getEntityId() );
			if ( ! is_null( $domain->getParentCommentId() ) ) {
				$keys[] = $commentService->getAllRepliesKey( $domain->getParentCommentId() );
			}
			if ( ! is_null( $domain->getParentCommentId() ) ) {
				$keys[] = $commentService->getLastFiveReplyKey( $domain->getParentCommentId() );
			}
			CacheServiceProvider::getService()->deleteKeys( $keys );

		}

		if ( is_callable( [ $domain, 'getUserId' ] ) ) {
			$user = UserServiceProvider::getService()->getUserFromCache( $domain->getUserId() );
			CacheServiceProvider::getService()->deleteKeys( [ 'pi:' . $user->getUsername() ] );
		}
	}
}