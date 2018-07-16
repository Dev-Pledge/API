<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 20:09
 */

namespace DevPledge\Application\Repository;

use DevPledge\Application\Factory\AbstractFactory;
use DevPledge\Application\Factory\ProblemFactory;
use DevPledge\Domain\AbstractDomain;
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
	public function create( Problem $problem ): AbstractDomain {
		return parent::create( $problem, 'problems', 'problem_id' );

	}

	/**
	 * @param Problem $domain
	 *
	 * @return Problem
	 * @throws \Exception
	 */
	public function update( Problem $domain ) {
		return parent::update( $domain, 'problems', 'problem_id' );
	}

	/**
	 * @param $id
	 *
	 * @return Problem
	 */
	public function read( $id ) {
		return parent::read( $id, 'users', 'user_id' );
	}


}