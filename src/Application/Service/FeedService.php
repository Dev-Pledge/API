<?php

namespace DevPledge\Application\Service;


use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\ActivitySpread;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Integrations;
use DevPledge\Uuid\Uuid;

/**
 * Class FeedService
 * @package DevPledge\Application\Service
 */
class FeedService {
	/**
	 * @var Client
	 */
	protected $cache;

	/**
	 * FeedService constructor.
	 *
	 * @param Cache $cache
	 */
	public function __construct( Cache $cache ) {
		$this->cache = $cache;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return FeedService
	 */
	public function send( \stdClass $data ): FeedService {

		$t            = json_encode( $data );
		shell_exec( 'php ' . Integrations::getBaseDir() . '/sendfeed.php "' . addslashes( $t ) . '" > /dev/null 2>/dev/null &' );

		return $this;
	}

	/**
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 */
	public function createdActivityFeed( AbstractDomain $domain, ?string $parentId = null ): void {
		$spread = $this->addToActivityFeedToCache( $domain, $parentId );
		$this->send( $spread->toFeed( 'created-entity' ) );
	}

	/**
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 */
	public function updatedActivityFeed( AbstractDomain $domain, ?string $parentId = null ): void {
		$spread = $this->addToActivityFeedToCache( $domain, $parentId );
		$this->send( $spread->toFeed( 'updated-entity' ) );
	}

	/**
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 */
	public function deletedActivityFeed( AbstractDomain $domain, ?string $parentId = null ): void {
		$spread = $this->deleteFromActivityFeedToCache( $domain, $parentId );
		$this->send( $spread->toFeed( 'deleted-entity' ) );
	}

	/**
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 *
	 * @return ActivitySpread
	 */
	public function addToActivityFeedToCache( AbstractDomain $domain, ?string $parentId = null ): ActivitySpread {
		if ( isset( $parentId ) ) {
			$parentUuid = new Uuid( $parentId );
			if ( ! in_array( $parentUuid->getEntity(), [ 'problem' ] ) ) {
				$parentId = null;
			}
		}

		$spread = new ActivitySpread( $domain );

		$unset = function ( &$array, $key ) use ( $spread, $parentId ) {
			$Akey = array_search( $spread->getId(), $array );
			if ( $Akey !== false ) {
				unset( $array[ $Akey ] );
			}
			if ( isset( $parentId ) ) {
				$Bkey = array_search( ( (object) [ 'id' => $spread->getId(), 'parent_id' => $parentId ] ), $array );
				if ( $Bkey !== false ) {
					unset( $array[ $Bkey ] );
				}
			}

		};

		$set = function ( &$array, $key ) use ( $spread, $parentId, $unset ) {
			$unset( $array, $key );
			if ( isset( $parentId ) ) {
				array_unshift( $array, ( (object) [ 'id' => $spread->getId(), 'parent_id' => $parentId ] ) );
			} else {
				array_unshift( $array, $spread->getId() );
			}
			if ( count( $array ) > 500 ) {
				array_slice( $array, 0, 500 );
			}
			$this->cache->set( $key, $array );
		};
		$new = function ( $key ) use ( $set ) {
			$array = [];
			$set( $array, $key );
		};
		$add = function ( $key ) use ( $set, $new ) {
			$json = $this->cache->get( $key );
			if ( $json ) {
				$existingData = $json;
				if ( is_array( $existingData ) ) {
					$array = $existingData;
					$set( $array, $key );
				}
			} else {
				$new( $key );
			}
		};
		if ( ! is_null( $spread->getUserId() ) ) {
			$key = 'activity-feed:' . $spread->getUserId();
			$add( $key );
		}
		if ( ! is_null( $spread->getTopics() ) ) {
			$topics = $spread->getTopics();
			$tops   = $topics->getTopics();
			foreach ( $tops as $top ) {
				$key = 'activity-feed:' . $top->getId();
				$add( $key );
			}

		}
		if ( ! is_null( $spread->getOrganisationId() ) ) {
			$key = 'activity-feed:' . $spread->getOrganisationId();
			$add( $key );
		}

		if ( ! is_null( $spread->getSolutionGroupId() ) ) {
			$key = 'activity-feed:' . $spread->getSolutionGroupId();
			$add( $key );
		}
		$spread->setParentId( $parentId );

		return $spread;
	}


	/**
	 * @param AbstractDomain $domain
	 * @param null|string $parentId
	 *
	 * @return ActivitySpread
	 */
	public function deleteFromActivityFeedToCache( AbstractDomain $domain, ?string $parentId = null ): ActivitySpread {
		if ( isset( $parentId ) ) {
			$parentUuid = new Uuid( $parentId );
			if ( ! in_array( $parentUuid->getEntity(), [ 'problem' ] ) ) {
				$parentId = null;
			}
		}

		$spread = new ActivitySpread( $domain );

		$unset  = function ( &$array, $key ) use ( $spread, $parentId ) {
			$Akey = array_search( $spread->getId(), $array );
			if ( $Akey !== false ) {
				unset( $array[ $Akey ] );
			}
			if ( isset( $parentId ) ) {
				$Bkey = array_search( ( (object) [ 'id' => $spread->getId(), 'parent_id' => $parentId ] ), $array );
				if ( $Bkey !== false ) {
					unset( $array[ $Bkey ] );
				}
			}
			$this->cache->set( $key, $array );
		};
		$new    = function ( $key ) use ( $unset ) {
			$array = [];
			$unset( $array, $key );
		};
		$delete = function ( $key ) use ( $unset, $new ) {
			$json = $this->cache->get( $key );
			if ( $json ) {
				$existingData = $json;
				if ( is_array( $existingData ) ) {
					$array = $existingData;
					$unset( $array, $key );
				}
			}
		};
		if ( ! is_null( $spread->getUserId() ) ) {
			$key = 'activity-feed:' . $spread->getUserId();
			$delete( $key );
		}
		if ( ! is_null( $spread->getTopics() ) ) {
			$topics = $spread->getTopics();
			$tops   = $topics->getTopics();
			foreach ( $tops as $top ) {
				$key = 'activity-feed:' . $top->getId();
				$delete( $key );
			}

		}
		if ( ! is_null( $spread->getOrganisationId() ) ) {
			$key = 'activity-feed:' . $spread->getOrganisationId();
			$delete( $key );
		}

		if ( ! is_null( $spread->getSolutionGroupId() ) ) {
			$key = 'activity-feed:' . $spread->getSolutionGroupId();
			$delete( $key );
		}
		$spread->setParentId( $parentId );

		return $spread;
	}


}