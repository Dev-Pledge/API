<?php

namespace DevPledge\Application\Events;


use DevPledge\Domain\AbstractDomain;
use DevPledge\Integrations\Event\AbstractEvent;

/**
 * Class CreatedDomainEvent
 * @package DevPledge\Application\Events
 */
class CreatedDomainEvent extends AbstractEvent {
	/**
	 * @var AbstractDomain
	 */
	protected $domain;
	/**
	 * @var string | null
	 */
	protected $parentId;

	/**
	 * CreatedDomainEvent constructor.
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