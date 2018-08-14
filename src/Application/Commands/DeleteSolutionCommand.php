<?php


namespace DevPledge\Application\Commands;


use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class DeleteSolutionCommand
 * @package DevPledge\Application\Commands
 */
class DeleteSolutionCommand extends AbstractCommand {
	/**
	 * @var string
	 */
	protected $solutionId;
	/**
	 * @var User
	 */
	protected $user;

	public function __construct( string $solutionId, User $user ) {
		$this->solutionId = $solutionId;
		$this->user       = $user;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getSolutionId(): string {
		return $this->solutionId;
	}
}