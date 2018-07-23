<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 15/07/2018
 * Time: 20:14
 */

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Application\Repository\ProblemRepository;
use DevPledge\Domain\Problem;
use DevPledge\Domain\Problems;
use DevPledge\Domain\User;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\Cache\Cache;

/**
 * Class ProblemService
 * @package DevPledge\Application\Service
 */
class ProblemService {
	/**
	 * @var  $repo
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
	 * @var Cached
	 */
	protected $cache;

	/**
	 * ProblemService constructor.
	 *
	 * @param ProblemRepository $repo
	 * @param ProblemFactory $factory
	 * @param UserService $userService
	 * @param Cache $cache
	 */
	public function __construct( ProblemRepository $repo, ProblemFactory $factory, UserService $userService ) {
		$this->repo        = $repo;
		$this->factory     = $factory;
		$this->userService = $userService;
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
	 *
	 * @return \DevPledge\Domain\Problem
	 * @throws \Exception
	 */
	public function update( Problem $problem ): Problem {
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
	 * @param $userId
	 *
	 * @return Problems|null
	 * @throws \Exception
	 */
	public function readAll( string $userId ): ?Problems {
		$problems = $this->repo->readAll( $userId );
		if ( $problems ) {
			return new Problems( $problems, $this->userService->getUserFromCache( $userId ) );
		}

		return null;
	}

}