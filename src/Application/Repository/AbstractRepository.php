<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Framework\Adapter\Adapter;

/**
 * Class AbstractRepository
 * @package DevPledge\Application\Repository
 */
abstract class AbstractRepository {
	/**
	 * @var Adapter
	 */
	protected $adapter;

	/**
	 * @var AbstractFactory
	 */
	protected $factory;


	/**
	 * AbstractRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param AbstractFactory $factory
	 */
	public function __construct( Adapter $adapter, AbstractFactory $factory ) {
		$this->adapter = $adapter;
		$this->factory = $factory;
	}

	/**
	 * @param AbstractDomain $domain
	 * @param $resource
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function create( AbstractDomain $domain, $resource ) {
		$this->adapter->create( $resource, $domain->toMap() );

		return $this->read( $domain->getId() );
	}

	/**
	 * @param AbstractDomain $domain
	 * @param $resource
	 * @param $column
	 *
	 * @return AbstractDomain
	 * @throws \Exception
	 */
	public function update( AbstractDomain $domain, $resource, $column ) {
		$domain->setModified( new \DateTime() );
		$this->adapter->update( $resource, $domain->getId(), $domain->toMap(), $column );

		return $this->read( $domain->getId(), $resource, $column );
	}

	/**
	 * @param $id
	 * @param $resource
	 * @param $column
	 *
	 * @return AbstractDomain
	 */
	public function read( $id, $resource, $column ) {
		$data = $this->adapter->read( $resource, $id, $column );

		return $this->factory->createFromPersistedData( $data );
	}

}