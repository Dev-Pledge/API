<?php


namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class UpdatePledgeWithSolution
 * @package DevPledge\Application\Commands
 */
class UpdatePledgeWithSolution extends AbstractCommand {
	/**
	 * @var string
	 */
	protected $pledgeId;
	/**
	 * @var string
	 */
	protected $solutionId;
	/**
	 * @var User
	 */
	protected $user;

	public function __construct( string $pledgeId, string $solutionId, User $user ) {
		$this->pledgeId   = $pledgeId;
		$this->solutionId = $solutionId;
		$this->user       = $user;
	}

	/**
	 * @return string
	 */
	public function getPledgeId(): string {
		return $this->pledgeId;
	}

	/**
	 * @return string
	 */
	public function getSolutionId(): string {
		return $this->solutionId;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}
}