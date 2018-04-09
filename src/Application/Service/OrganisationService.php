<?php

namespace DevPledge\Application\Services;

use DevPledge\Application\Factory\OrganisationFactory;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;
use DevPledge\Domain\Organisation;




/**
 * Class OrganisationService
 * @package DevPledge\Application\Services
 */
class OrganisationService {
	/**
	 * @var OrganisationRepository $repo
	 */
	protected $repo;
	/**
	 * @var OrganisationFactory $factory
	 */
	private $factory;

	/**
	 * OrganisationService constructor.
	 *
	 * @param OrganisationRepository $repository
	 * @param OrganisationFactory $factory
	 */
	public function __construct( OrganisationRepository $repository, OrganisationFactory $factory ) {

		$this->repo    = $repository;
		$this->factory = $factory;
	}

	/**
	 * @param string $name
	 *
	 * @return \DevPledge\Domain\Organisation
	 * @throws \Exception
	 */
	public function create( string $name ) {
		$organisation = $this->factory->create( [
			'name' => $name,
		] );

		return $this->repo->create( $organisation );
	}

	/**
	 * @param string $id
	 *
	 * @return Organisation
	 */
	public function read( string $id ): Organisation {
		return $this->repo->read( $id );
	}

	/**
	 * @param Organisation $organisation
	 *
	 * @param array $data
	 *
	 * @return Organisation
	 * @throws \Exception
	 */
	public function update( Organisation $organisation, array $data = [] ): Organisation {
		$organisation = $this->factory->update( $organisation, $data );

		return $this->repo->update( $organisation );
	}

	/**
	 * @param array $filters
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function readAll( array $filters ): array {
		return $this->repo->readAll( $filters );
	}

}