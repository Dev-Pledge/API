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
	 * @var TopicService
	 */
	protected $topic;

	/**
	 * ProblemService constructor.
	 *
	 * @param ProblemRepository $repo
	 * @param ProblemFactory $factory
	 * @param TopicService $topic
	 */
	public function __construct( ProblemRepository $repo, ProblemFactory $factory, TopicService $topic ) {
		$this->repo    = $repo;
		$this->factory = $factory;
		$this->topic   = $topic;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function create( \stdClass $data ) {

		$problem = $this->factory->create( $data );

		$problem = $this->repo->createPersist( $problem );

		return $problem;
	}

	public function update( Problem $problem ) {
		return $this->repo->update( $problem );
	}


}