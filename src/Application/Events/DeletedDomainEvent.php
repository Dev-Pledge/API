<?php

namespace DevPledge\Application\Events;


use DevPledge\Domain\AbstractDomain;
use DevPledge\Integrations\Event\AbstractEvent;

/**
 * Class DeletedDomainEvent
 * @package DevPledge\Application\Events
 */
class DeletedDomainEvent extends AbstractEvent {
	/**
	 * @var AbstractDomain
	 */
	protected $domain;
	/**
	 * @var string | null
	 */
	protected $parentId;

	/**
	 * DeletedDomainEvent constructor.
	 *
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 */
	public function __construct( AbstractDomain $domain, ?string $parentId = null) {
		$this->domain   = $domain;
		$this->parentId = $parentId;
	}

	/**
	 * @return AbstractDomain|string
	 */
	public function getDomain() {
		return $this->domain;
	}

	/**
	 * @return null|string
	 */
	public function getParentId(): ?string {
		return $this->parentId;
	}
}