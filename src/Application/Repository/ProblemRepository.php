<?php

namespace DevPledge\Application\Repository;

use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Domain\Problem;
use DevPledge\Framework\Adapter\Adapter;

/**
 * Class ProblemRepository
 * @package DevPledge\Application\Repository
 */
class ProblemRepository extends AbstractRepository {
	/**
	 * ProblemRepository constructor.
	 *
	 * @param Adapter $adapter
	 * @param ProblemFactory $factory
	 */
	public function __construct( Adapter $adapter, ProblemFactory $factory ) {
		parent::__construct( $adapter, $factory );
	}

	/**
	 * @param Problem $problem
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function create( Problem $problem ): Problem {
		return parent::create( $problem, 'problems', 'problem_id' );

	}

	/**
	 * @param Problem $domain
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function update( Problem $domain ): Problem {
		return parent::update( $domain, 'problems', 'problem_id' );
	}

	/**
	 * @param $id
	 *
	 * @return Problem
	 */
	public function read( $id ): Problem {
		return parent::read( $id, 'problems', 'problem_id' );
	}


}