<?php

namespace DevPledge\Application\Service;

use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Application\Factory\SolutionFactory;
use DevPledge\Application\Repository\SolutionRepository;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Solution;
use DevPledge\Domain\Solutions;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Integrations\Command\Dispatch;

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
		if ( $solution->isPersistedDataFound() ) {

			Dispatch::event( new CreatedDomainEvent( $solution, $solution->getProblemId() ) );
		}

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


		$solution = $this->repo->update( $solution );
		Dispatch::event( new UpdatedDomainEvent( $solution, $solution->getProblemId() ) );

		return $solution;
	}

	/**
	 * @param string $solutionId
	 *
	 * @return Solution
	 */
	public function read( string $solutionId ): Solution {
		return $this->repo->read( $solutionId );
	}

	public function delete( string $solutionId ): ?int {
		$solution = $this->read( $solutionId );
		$delete   = $this->repo->delete( $solutionId );
		if ( $delete ) {
			Dispatch::event( new UpdatedDomainEvent( $solution, $solution->getProblemId() ) );
		}

		return $delete;
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


	/**
	 * @param Problem $problem
	 * @param string $openSourceLocation
	 *
	 * @return array|null
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function getProblemSolutionWithOpenSourceLocation( Problem $problem, string $openSourceLocation ): ?array {
		return $this->repo->readAllWhere( new Wheres(
			[
				new Where( 'open_source_location', trim( $openSourceLocation ) ),
				new Where( 'problem_id', $problem->getId() )
			]
		), 'open_source_location' );
	}

	/**
	 * @param string $userId
	 *
	 * @return Solutions
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function getUserSolutions( string $userId ): Solutions {
		$solutions = $this->repo->readAllWhere( new Wheres( [ new Where( 'user_id', $userId ) ] ) );
		if ( $solutions ) {
			return new Solutions( $solutions );
		}

		return new Solutions( [] );
	}

}