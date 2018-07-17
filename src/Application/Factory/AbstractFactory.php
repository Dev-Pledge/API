<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\Data;
use DevPledge\Integrations\Sentry;
use DevPledge\Uuid\Uuid;

/**
 * Class AbstractFactory
 * @package DevPledge\Application\Factory
 */
abstract class AbstractFactory {
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
	 * @var string
	 */
	protected $primaryIdColumn;

	/**
	 * AbstractFactory constructor.
	 *
	 * @param $productObjectClassString
	 * @param $uuidEntity
	 * @param $primaryIdColumn
	 *
	 * @throws FactoryException
	 */
	public function __construct( $productObjectClassString, $uuidEntity, $primaryIdColumn ) {

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
	 * @param $key
	 * @param $setMethod
	 * @param null $useClass
	 * @param \Closure|null $onSetCallback
	 *
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setMethodToProductObject( $key, $setMethod, $useClass = null, \Closure $onSetCallback = null ) {

		if ( isset( $this->rawData->{$key} ) ) {
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
	 */
	public function createFromPersistedData( \stdClass $rawData ) {
		try {
			return $this->setRawData( $rawData )
			            ->newProductObject()
			            ->setUuid( true )
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCreatedModified()
			            ->getProductObject();
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->getProductObject();
	}

	/**
	 * @param \stdClass $rawData
	 *
	 * @return AbstractDomain
	 */
	public function create( \stdClass $rawData ) {
		try {
			return $this->setRawData( $rawData )
			            ->newProductObject()
			            ->setUuid()
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCreatedModified()
			            ->getProductObject();
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->getProductObject();
	}

	/**
	 * @param AbstractDomain $productObject
	 * @param \stdClass $rawUpdateData
	 *
	 * @return AbstractDomain
	 * @throws FactoryException
	 */
	public function update( AbstractDomain $productObject, \stdClass $rawUpdateData ) {
		try {
			return $this->setProductObject( $productObject )
			            ->setRawData( $rawUpdateData )
			            ->setUuid()
			            ->setData()
			            ->setMethodsToProductObject()
			            ->setCreatedModified()
			            ->getProductObject();
		} catch ( FactoryException $exception ) {
			Sentry::get()->captureException( $exception );
		}

		return $this->getProductObject();
	}

	/**
	 * @param bool $fromPersistedData
	 *
	 * @return $this
	 * @throws FactoryException
	 */
	protected function setUuid( $fromPersistedData = false ) {
		try {
			$this->setMethodToProductObject( $this->primaryIdColumn, 'setUuid', Uuid::class, function ( AbstractDomain $domain ) use ( $fromPersistedData ) {
				if ( $fromPersistedData ) {
					$domain->setPersistedDataFound( true );
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