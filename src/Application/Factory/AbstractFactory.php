<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\AbstractDomain;

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
	protected $productObjectClassString;
	protected $entity;

	/**
	 * AbstractFactory constructor.
	 *
	 * @param $productObjectClassString
	 * @param $entity
	 */
	public function __construct( $productObjectClassString, $entity ) {

		$productObject = new $productObjectClassString( $entity );
		if ( ! $productObject instanceof AbstractDomain ) {
			throw new \DomainException( 'AbstractDomain must be used!' );
		}
		$this->productObject            = $productObject;
		$this->productObjectClassString = $productObjectClassString;
		$this->entity                   = $entity;
	}

	/**
	 * @return AbstractDomain
	 */
	public function getProductObject(): AbstractDomain {
		return $this->productObject;
	}

	/**
	 * @return $this
	 */
	public function newProductObject() {
		return $this->setProductObject( new $this->productObjectClassString( $this->entity ) );

	}

	/**
	 * @return \stdClass
	 */
	public function getRawData(): \stdClass {
		return $this->rawData;
	}

	/**
	 * @param string $rawData
	 *
	 * @return $this
	 */
	public function setRawData( \stdClass $rawData ) {
		$this->rawData = $rawData;

		return $this;
	}

	/**
	 * @param AbstractDomain $productObject
	 *
	 * @return AbstractFactory
	 */
	public function setProductObject( AbstractDomain $productObject ): AbstractFactory {
		$this->productObject = $productObject;

		return $this;
	}

	/**
	 * @param $key
	 * @param $setMethod
	 * @param null $useClass
	 *
	 * @return $this
	 */
	protected function setMethodToProductObject( $key, $setMethod, $useClass = null ) {
		if ( isset( $this->rawData->{$key} ) ) {
			if ( is_callable( array( $this->productObject, $setMethod ) ) ) {
				if ( ! is_null( $useClass ) ) {
					$this->productObject->{$setMethod}( new $useClass( $this->rawData->{$key} ) );
				} else {
					$this->productObject->{$setMethod}( $this->rawData->{$key} );
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
	public function create( \stdClass $rawData ) {
		return $this->setRawData( $rawData )
		            ->newProductObject()
		            ->creationProcess()
		            ->updateProcess()
		            ->getProductObject();
	}

	/**
	 * @param AbstractDomain $productObject
	 * @param \stdClass $rawUpdateData
	 *
	 * @return AbstractDomain
	 */
	public function update( AbstractDomain $productObject, \stdClass $rawUpdateData ) {
		return $this->setProductObject( $productObject )
		            ->setRawData( $rawUpdateData )
		            ->updateProcess()
		            ->getProductObject();

	}

	/**
	 * @return $this
	 */
	abstract function creationProcess();

	/**
	 * @return $this
	 */
	abstract function updateProcess();
}