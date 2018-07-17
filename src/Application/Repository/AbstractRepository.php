<?php

namespace DevPledge\Application\Repository;


use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Application\Mapper\Mappable;
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
	public function create( Mappable $domain ): AbstractDomain {
		$this->adapter->create( $this->getResource(), $domain->toMap() );

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
	public function update( Mappable $domain ): AbstractDomain {
		$domain->setModified( new \DateTime() );
		$this->adapter->update( $this->getResource(), $domain->getId(), $domain->toMap(), $this->getColumn() );

		return $this->read( $domain->getId(), $this->getResource(), $this->getColumn() );
	}

	/**
	 * @param $id
	 * @param $resource
	 * @param $column
	 *
	 * @return AbstractDomain
	 */
	public function read( string $id ): AbstractDomain {

		$data = $this->adapter->read( $this->getResource(), $id, $this->getColumn() );
		return $this->factory->createFromPersistedData( $data );
	}

	/**
	 * @return string
	 */
	abstract protected function getResource(): string;

	/**
	 * @return string
	 */
	abstract protected function getColumn(): string;
}