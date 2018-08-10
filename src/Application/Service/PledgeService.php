<?php


namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\PledgeFactory;
use DevPledge\Application\Repository\PledgeRepository;
use DevPledge\Domain\Pledge;

/**
 * Class PledgeService
 * @package DevPledge\Application\Service
 */
class PledgeService {
	/**
	 * @var PledgeRepository
	 */
	protected $repo;

	/**
	 * @var PledgeFactory $factory
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
	 * PledgeService constructor.
	 *
	 * @param PledgeRepository $repo
	 * @param PledgeFactory $factory
	 * @param UserService $userService
	 * @param SolutionService $solutionService
	 */
	public function __construct( PledgeRepository $repo, PledgeFactory $factory, UserService $userService, SolutionService $solutionService ) {
		$this->repo            = $repo;
		$this->factory         = $factory;
		$this->userService     = $userService;
		$this->solutionService = $solutionService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Pledge
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Pledge {

		$pledge = $this->factory->create( $data );

		$pledge = $this->repo->createPersist( $pledge );

		return $pledge;
	}


	/**
	 * @param Pledge $pledge
	 * @param \stdClass $rawUpdateData
	 *
	 * @return Pledge
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Pledge $pledge, \stdClass $rawUpdateData ): Pledge {
		$pledge = $this->factory->update( $pledge, $rawUpdateData );

		return $this->repo->update( $pledge );
	}

	/**
	 * @param string $pledgeId
	 *
	 * @return Pledge
	 */
	public function read( string $pledgeId ): Pledge {
		return $this->repo->read( $pledgeId );
	}

	/**
	 * @param string $pledgeId
	 *
	 * @return int|null
	 */
	public function delete( string $pledgeId ): ?int {
		return $this->repo->delete( $pledgeId );
	}

	/**
	 * @param $problemId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function getPledgeCountFromByProblemId( $problemId ): int {
		return $this->repo->countAllInAllColumn( $problemId );
	}

	/**
	 * @param $problemId
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function getPledgeValueByProblemId( $problemId ): float {
		return $this->repo->sumInAllColumnCurrency( $problemId );
	}

}