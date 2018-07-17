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
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;

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
	 * ProblemService constructor.
	 *
	 * @param ProblemRepository $repo
	 * @param ProblemFactory $factory
	 */
	public function __construct( ProblemRepository $repo, ProblemFactory $factory ) {
		$this->repo    = $repo;
		$this->factory = $factory;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function create( \stdClass $data ) {
		$problem = $this->factory->create( $data );
		return $this->repo->create( $problem );
	}

	public function update(Problem $problem){
		return $this->repo->update( $problem);
	}
}