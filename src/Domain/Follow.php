<?php

namespace DevPledge\Domain;


use DevPledge\Domain\Fetcher\FetchCacheUser;
use DevPledge\Domain\Fetcher\FetchTopic;

/**
 * Class Follow
 * @package DevPledge\Domain
 */
class Follow extends AbstractDomainDualUuid {

	public function getName() {
		return $this->name;
	}

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

	/**
	 * @return \stdClass
	 */
	function toAPIMap(): \stdClass {
		$data                = parent::toAPIMap();
		$data->follow_entity = null;
		if ( $this->getEntity() == 'user' ) {
			$data->user = ( new FetchCacheUser( $this->getEntityId() ) )->toPublicAPIMap();
		}
		if ( $this->getEntity() == 'topic' ) {
			$data->topic = ( new FetchTopic( $this->getEntityId() ) )->toAPIMap();
		}

		return $data;
	}


}