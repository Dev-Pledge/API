<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\CommentsTrait;
use DevPledge\Domain\Data;
use DevPledge\Domain\Fetcher\FetchCommentCount;
use DevPledge\Domain\Fetcher\FetchLastFiveComments;
use DevPledge\Integrations\Sentry;
use DevPledge\Uuid\Uuid;

/**
 * Class AbstractFactory
 * @package DevPledge\Application\Factory
 */
abstract class AbstractFactory {
	/**
	 * @var string
	 */
	protected $spawnId;
	/**
	 * @var AbstractFactory[]
	 */
	protected static $spawnChildren = [];
	/**
	 * @var bool
	 */
	protected $inUse = false;
	/**
	 * @var \stdClass
	 */
	protected $rawData;
	/**
	 * @var AbstractDomain
	 */
	protected $productObject;
	/**
	 * @var string
	 */
	protected $productObjectClassString;
	/**
	 * @var string
	 */
	protected $entity;
	/**
	 * @var string| string[]
	 */
	protected $primaryIdColumn;
	/**
	 * @var string
	 */
	protected $uuidClass = Uuid::class;
	/**
	 * @var string
	 */
	protected $setUuidMethod = 'setUuid';

	/**
	 * AbstractFactory constructor.
	 *
	 * @param $productObjectClassString
	 * @param $uuidEntity
	 * @param $primaryIdColumn string | string[]
	 *
	 * @throws FactoryException
	 */
	public function __construct( $productObjectClassString, $uuidEntity, $primaryIdColumn ) {

		if ( ! ( is_string( $primaryIdColumn ) || is_array( $primaryIdColumn ) ) ) {
			throw new FactoryException( 'Only String or Array Accepted for $primaryIdColumn' );
		}
		$this->spawnId = uniqid();
		$productObject = new $productObjectClassString( $uuidEntity );
		if ( ! $productObject instanceof AbstractDomain ) {
			throw new FactoryException( 'AbstractDomain must be used!' );
		}
		$this->productObject            = $productObject;
		$this->productObjectClassString = $productObjectClassString;
		$this->entity                   = $uuidEntity;
		$this->primaryIdColumn          = $primaryIdColumn;
	}

	/**
	 * @return bool
	 */
	public function isInUse(): bool {
		return $this->inUse;
	}

	/**
	 * @return AbstractFactory
	 * @throws FactoryException
	 */
	protected function getThis(): AbstractFactory {
		if ( $this->inUse ) {
			$freeChild = false;
			$class     = get_called_class();
			if ( isset( static::$spawnChildren[ $class ] ) ) {

				foreach ( static::$spawnChildren[ $class ] as &$child ) {
					if ( ! $child->isInUse() ) {
						$freeChild = $child;
					}
				}
			} else {
				static::$spawnChildren[ $class ] = [];
			}
			if ( ! $freeChild ) {
				static::$spawnChildren[ $class ][] = $freeChild = new static( $this->productObjectClassString, $this->entity, $this->primaryIdColumn );
			}

			return $freeChild;
		}

		$this->inUse = true;

		return $this;
	}

	/**
	 * @return $this
	 */
	protected function endThis() {
		$this->inUse = false;
		$class       = get_called_class();
		if ( static::$spawnChildren[ $class ] ) {
			foreach ( static::$spawnChildren[ $class ] as $index => &$child ) {
				if ( ! $child->isInUse() && $this !== $child ) {
					unset( static::$spawnChildren[ $class ][ $index ] );
				}
			}
		}

		return $this;
	}

	/**
	 * @return AbstractDomain
	 */
	protected function getProductObject(): AbstractDomain {

		return $this->productObject;
	}

	/**
	 * @return $this
	 */
	protected function newProductObject() {

		return $this->setProductObject( new $this->productObjectClassString( $this->entity ) );

	}

	/**
	 * @return \stdClass
	 */
	protected function getRawData(): \stdClass {
		return $this->rawData;
	}

	/**
	 * @param string $rawData
	 *
	 * @return $this
	 */
	protected function setRawData( \stdClass $rawData ) {
		$this->rawData = $rawData;

		return $this;
	}

	/**
	 * @param AbstractDomain $productObject
	 *
	 * @return AbstractFactory
	 */
	protected function setProductObject( AbstractDomain $productObject ): AbstractFactory {
		$this->productObject = $productObject;

		return $this;
	}

	/**
	 * @param $key string | string[]
	 * @param $setMethod
	 * @param null $useClass
	 * @param \Closure|null $onSetCallback
	 *
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setMethodToProductObject( $key, $setMethod, $useClass = null, \Closure $onSetCallback = null ) {

		if ( is_array( $key ) && count( $key ) ) {
			$rawArray = [];
			foreach ( $key as $k ) {
				if ( ! isset( $this->rawData->{$k} ) ) {
					return $this;
				}
				$rawArray[] = $this->rawData->{$k};
			}
			if ( is_callable( array( $this->productObject, $setMethod ) ) ) {
				try {
					if ( ! is_null( $useClass ) ) {
						$this->productObject->{$setMethod}( new $useClass( ...$rawArray ) );
					} else {
						$this->productObject->{$setMethod}( ...$rawArray );
					}
				} catch ( \Error $error ) {
					throw new FactoryException( $error->getMessage() );
				}
				if ( ! is_null( $onSetCallback ) ) {
					call_user_func_array( $onSetCallback, [ $this->productObject ] );
				}
			}

		} else if ( isset( $this->rawData->{$key} ) ) {
			if ( is_callable( array( $this->productObject, $setMethod ) ) ) {
				try {
					if ( ! is_null( $useClass ) ) {
						$this->productObject->{$setMethod}( new $useClass( $this->rawData->{$key} ) );
					} else {
						$this->productObject->{$setMethod}( $this->rawData->{$key} );
					}
				} catch ( \Error $error ) {
					throw new FactoryException( $error->getMessage() );
				}
				if ( ! is_null( $onSetCallback ) ) {
					call_user_func_array( $onSetCallback, [ $this->productObject ] );
				}
			}
		}

		return $this;
	}

	/**
	 * @param \stdClass $rawData
	 *
	 * @return AbstractDomain
	 * @throws FactoryException
	 */
	public function createFromPersistedData( \stdClass $rawData ) {
		$that = $this->getThis();
		if ( $that !== $this ) {
			return $that->createFromPersistedData( $rawData );
		}
		try {
			return $this->setRawData( $rawData )
			            ->newProductObject()
			            ->setUuid( true )
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCommentsData()
			            ->setCreatedModified()
			            ->endThis()
			            ->getProductObject();

		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->endThis()->getProductObject();
	}


	/**
	 * @param \stdClass $rawData
	 *
	 * @return AbstractDomain
	 * @throws FactoryException
	 */
	public function create( \stdClass $rawData ) {
		$that = $this->getThis();
		if ( $that !== $this ) {
			return $that->create( $rawData );
		}
		try {
			return $this->setRawData( $rawData )
			            ->newProductObject()
			            ->setUuid()
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCommentsData()
			            ->setCreatedModified()
			            ->endThis()
			            ->getProductObject();
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->endThis()->getProductObject();
	}

	/**
	 * @param AbstractDomain $productObject
	 * @param \stdClass $rawUpdateData
	 *
	 * @return AbstractDomain
	 * @throws FactoryException
	 */
	public function update( AbstractDomain $productObject, \stdClass $rawUpdateData ) {
		$that = $this->getThis();
		if ( $that !== $this ) {
			return $that->update( $productObject, $rawUpdateData );
		}
		try {
			return $this->setProductObject( $productObject )
			            ->setRawData( $rawUpdateData )
			            ->setUuid()
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCommentsData()
			            ->setCreatedModified()
			            ->endThis()
			            ->getProductObject();
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->endThis()->getProductObject();
	}

	/**
	 * @param bool $fromPersistedData
	 *
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setUuid( $fromPersistedData = false ) {
		try {
			$this->setMethodToProductObject( $this->primaryIdColumn, $this->setUuidMethod, $this->uuidClass, function ( AbstractDomain $domain ) use ( $fromPersistedData ) {
				if ( $fromPersistedData ) {
					$domain->setPersistedDataFound( true );

					if ( $domain->getUuid()->getEntity() !== $this->entity ) {
						throw new \TypeError(
							'Persisted Entity Type `' . $domain->getUuid()->getEntity() . '` Does not match ' .
							$this->entity
						);
					}
				}
			} );
		} catch ( \InvalidArgumentException $exception ) {
			throw new FactoryException( $exception->getMessage() );
		}

		return $this;
	}

	/**
	 * @param $key
	 *
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setData() {

		return $this
			->setMethodToProductObject(
				'data',
				'setData',
				Data::class
			);

	}

	/**
	 * @return $this
	 */
	protected function setCommentsData() {
		try {
			if (
			in_array(
				CommentsTrait::class,
				class_uses( $this->getProductObject() )
			) ) {
				$this
					->setMethodToProductObject(
						$this->primaryIdColumn,
						'setLastFiveComments',
						FetchLastFiveComments::class
					)
					->setMethodToProductObject(
						$this->primaryIdColumn,
						'setTotalComments',
						FetchCommentCount::class
					);
			}
		} catch ( \TypeError | \Exception $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setCreatedModified() {

		return $this
			->setMethodToProductObject(
				'created',
				'setCreated',
				\DateTime::class
			)
			->setMethodToProductObject(
				'modified',
				'setModified',
				\DateTime::class
			);
	}

	/**
	 * @return $this
	 */
	abstract function setMethodsToProductObject();


}