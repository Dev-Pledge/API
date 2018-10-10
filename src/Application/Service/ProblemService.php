<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Application\Repository\ProblemRepository;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Problems;
use DevPledge\Integrations\Cache\Cache;
use DevPledge\Integrations\Command\Dispatch;

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
	 * @var Cache
	 */
	protected $cacheService;


	/**
	 * ProblemService constructor.
	 *
	 * @param ProblemRepository $repo
	 * @param ProblemFactory $factory
	 * @param UserService $userService
	 * @param SolutionService $solutionService
	 * @param Cache $cacheService
	 */
	public function __construct(
		ProblemRepository $repo,
		ProblemFactory $factory,
		UserService $userService,
		SolutionService $solutionService,
		Cache $cacheService
	) {
		$this->repo            = $repo;
		$this->factory         = $factory;
		$this->userService     = $userService;
		$this->solutionService = $solutionService;
		$this->cacheService    = $cacheService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Problem {

		$problem = $this->factory->create( $data );
		/**
		 * @var $problem Problem
		 */
		$problem = $this->repo->createPersist( $problem );

		Dispatch::event( new CreatedDomainEvent( $problem ) );


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
		$problem = $this->repo->update( $problem );

		Dispatch::event( new UpdatedDomainEvent( $problem ) );


		return $problem;
	}

	/**
	 * @param string $problemId
	 *
	 * @return Problem
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function read( string $problemId ): Problem {
		return $this->repo->read( $problemId );
	}

	/**
	 * @param string $problemId
	 *
	 * @return int|null
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function delete( string $problemId ): ?int {

		$problem = $this->read( $problemId );

		$deleted = $this->repo->delete( $problemId );

		if ( $deleted ) {
			Dispatch::event( new DeletedDomainEvent( $problem ) );
		}

		return $deleted;
	}

	/**
	 * @param $userId
	 *
	 * @return Problems
	 * @throws \Exception
	 */
	public function readAll( string $userId ): Problems {

		$key                  = 'all-prb-user:' . $userId;
		$allCacheUserProblems = $this->cacheService->get( $key );

		if ( $allCacheUserProblems ) {
			return unserialize( $allCacheUserProblems );
		}
		$problems = $this->repo->readAll( $userId, 'created', true );

		if ( $problems ) {
			$allUserProblems = new Problems( $problems );
			$this->cacheService->setEx( $key, serialize( $allUserProblems ), 30 );

			return $allUserProblems;
		}

		return new Problems( [] );

	}


}