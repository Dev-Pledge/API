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
}