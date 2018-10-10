<?php

namespace DevPledge\Application\EventHandlers\SendFeed;


use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Framework\ServiceProviders\FeedServiceProvider;
use DevPledge\Integrations\Event\AbstractEventHandler;

/**
 * Class UpdatedDomainHandler
 * @package DevPledge\Application\EventHandlers
 */
class SendFeedDomainDeletedHandler extends AbstractEventHandler {
	/**
	 * SendFeedDomainUpdatedHandler constructor.
	 */
	public function __construct() {
		parent::__construct( DeletedDomainEvent::class );
	}

	/**
	 * @param $event UpdatedDomainEvent
	 */
	protected function handle( $event ) {
		$domain = $event->getDomain();

		if ( $domain->isActive() ) {
			$parentId    = $event->getParentId();
			$feedService = FeedServiceProvider::getService();
			$feedService->updatedActivityFeed( $domain, $parentId );
		}
	}
}