<?php

namespace DevPledge\Application\EventHandlers\SendFeed;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Framework\ServiceProviders\FeedServiceProvider;
use DevPledge\Integrations\Event\AbstractEventHandler;

/**
 * Class SendFeedDomainCreatedHandler
 * @package DevPledge\Application\EventHandlers
 */
class SendFeedDomainCreatedHandler extends AbstractEventHandler {
	/**
	 * SendFeedDomainUpdatedHandler constructor.
	 */
	public function __construct() {
		parent::__construct( CreatedDomainEvent::class );
	}

	/**
	 * @param $event CreatedDomainEvent
	 */
	protected function handle( $event ) {
		$domain = $event->getDomain();

		if ( $domain->isActive() ) {
			$parentId    = $event->getParentId();
			$feedService = FeedServiceProvider::getService();
			$feedService->createdActivityFeed( $domain, $parentId );
		}
	}
}