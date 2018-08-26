<?php

namespace DevPledge\Domain;


/**
 * Class Follow
 * @package DevPledge\Domain
 */
class Follow extends AbstractDomainDualUuid {

	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->getDualUuid()->getPrimaryId();
	}

	/**
	 * @return string
	 */
	public function getEntityId(): string {
		return $this->getDualUuid()->getSecondaryId();
	}


	/**
	 * @return string
	 */
	public function getEntity(): string {
		return $this->getDualUuid()->getSecondaryIdEntity();
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'user_id'   => $this->getUserId(),
			'entity_id' => $this->getEntityId(),
			'entity'    => $this->getEntity(),
			'created'   => $this->getCreated()->format( 'Y-m-d H:i:s' )
		];
	}



}