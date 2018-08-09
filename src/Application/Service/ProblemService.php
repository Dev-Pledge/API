<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Application\Repository\ProblemRepository;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Problems;
use DevPledge\Integrations\Cache\Cache;

/**
 * Class ProblemService
 * @package DevPledge\Application\Service
 */
class ProblemService {
	/**
	 * @var  ProblemRepository
	 */
	protected $repo;

	/**
	 * @var ProblemFactory $factory
	 */
	protected $factory;
	/**
	 * @var UserService
	 */
	protected $userService;
	/**
	 * @var SolutionService
	 */
	protected $solutionService;

	/**
	 * ProblemService constructor.
	 *
	 * @param ProblemRepository $repo
	 * @param ProblemFactory $factory
	 * @param UserService $userService
	 * @param SolutionService $solutionService
	 */
	public function __construct( ProblemRepository $repo, ProblemFactory $factory, UserService $userService, SolutionService $solutionService ) {
		$this->repo            = $repo;
		$this->factory         = $factory;
		$this->userService     = $userService;
		$this->solutionService = $solutionService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Problem {

		$problem = $this->factory->create( $data );

		$problem = $this->repo->createPersist( $problem );

		return $problem;
	}

	/**
	 * @param Problem $problem
	 * @param \stdClass $rawUpdateData
	 *
	 * @return Problem
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Problem $problem, \stdClass $rawUpdateData ): Problem {
		$problem = $this->factory->update( $problem, $rawUpdateData );

		return $this->repo->update( $problem );
	}

	/**
	 * @param string $problemId
	 *
	 * @return Problem
	 */
	public function read( string $problemId ): Problem {
		return $this->repo->read( $problemId );
	}

	/**
	 * @param string $problemId
	 *
	 * @return int|null
	 */
	public function delete( string $problemId ): ?int {
		return $this->repo->delete( $problemId );
	}

	/**
	 * @param $userId
	 *
	 * @return Problems
	 * @throws \Exception
	 */
	public function readAll( string $userId ): Problems {
		$problems = $this->repo->readAll( $userId, 'created', true );
		if ( $problems ) {
			return new Problems( $problems );
		}

		return new Problems( [] );
	}


}