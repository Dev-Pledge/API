<?php

namespace DevPledge\Application\Service;

use DevPledge\Application\Factory\SolutionFactory;
use DevPledge\Application\Repository\SolutionRepository;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Solution;
use DevPledge\Domain\Solutions;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Integrations\Cache\Cache;

/**
 * Class SolutionService
 * @package DevPledge\Application\Service
 */
class SolutionService {
	/**
	 * @var SolutionRepository
	 */
	protected $repo;
	/**
	 * @var SolutionFactory
	 */
	protected $factory;

	/**
	 * @var UserService
	 */
	protected $userService;

	/**
	 * SolutionService constructor.
	 *
	 * @param SolutionRepository $repo
	 * @param SolutionFactory $factory
	 * @param UserService $userService
	 */
	public function __construct( SolutionRepository $repo, SolutionFactory $factory, UserService $userService ) {
		$this->repo        = $repo;
		$this->factory     = $factory;
		$this->userService = $userService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Solution
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Solution {
		$solution = $this->factory->create( $data );
		$solution = $this->repo->createPersist( $solution );

		return $solution;
	}

	/**
	 * @param Solution $solution
	 * @param \stdClass $data
	 *
	 * @return Solution
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Solution $solution, \stdClass $data ): Solution {
		$solution = $this->factory->update( $solution, $data );

		return $this->repo->update( $solution );

	}

	/**
	 * @param string $solutionId
	 *
	 * @return Solution
	 */
	public function read( string $solutionId ): Solution {
		return $this->repo->read( $solutionId );
	}

	public function delete( string $id ): ?int {
		return $this->repo->delete( $id );
	}

	/**
	 * @param string $problemId
	 *
	 * @return Solutions|null
	 * @throws \Exception
	 */
	public function readAll( string $problemId ): ?Solutions {
		/**
		 * @var $solutions Solution[]
		 */
		$solutions = $this->repo->readAll( $problemId, 'created', true );
		if ( $solutions ) {
			return new Solutions( $solutions );
		}

		return new Solutions( [] );
	}

	/**
	 * @param Problem $problem
	 * @param string $name
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	public function getProblemSolutionWithName( Problem $problem, string $name ) {

		return $this->repo->readAllWhere( new Wheres(
			[
				new Where( 'name', trim( $name ) ),
				new Where( 'problem_id', $problem->getId() )
			]
		), 'name' );
	}

	public function getProblemSolutionWithOpenSourceLocation( Problem $problem, string $openSourceLocation ) {
		return $this->repo->readAllWhere( new Wheres(
			[
				new Where( 'open_source_location', trim( $openSourceLocation ) ),
				new Where( 'problem_id', $problem->getId() )
			]
		), 'open_source_location' );
	}

}