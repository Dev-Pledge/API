<?php

namespace DevPledge\Application\Repository\Organisation;


use DevPledge\Application\Factory\OrganisationFactory;
use TomWright\Database\ExtendedPDO\ExtendedPDO;
use DevPledge\Domain\Organisation;

class OrganisationMySQLRepository implements OrganisationRepository {

	/**
	 * @var ExtendedPDO
	 */
	private $db;
	/**
	 * @var OrganisationFactory
	 */
	protected $factory;

	/**
	 * OrganisationMySQLRepository constructor.
	 *
	 * @param ExtendedPDO $db
	 * @param OrganisationFactory $factory
	 */
	public function __construct( ExtendedPDO $db, OrganisationFactory $factory ) {
		$this->db      = $db;
		$this->factory = $factory;
	}

	/**
	 * @param int $id
	 *
	 * @return Organisation
	 */
	public function getOrganisation( int $id ): Organisation {
		// TODO: Implement getOrganisation() method.
		$data = new \stdClass();

		$data->somecrap = 'ppop';

		return $this->factory->create( $data );
	}

	/**
	 * @param array $filters
	 *
	 * @return Organisation[]
	 */
	public function searchOrganisations( array $filters ): array {
		// TODO: Implement searchOrganisations() method.
	}

	/**
	 * @param Organisation $organisation
	 *
	 * @return Organisation
	 */
	public function saveOrganisation( Organisation $organisation ): Organisation {
		// TODO: Implement saveOrganisation() method.
	}
}