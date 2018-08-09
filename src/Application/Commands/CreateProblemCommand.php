<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\Organisation;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateProblemCommand
 * @package DevPledge\Application\Commands
 */
class CreateProblemCommand extends AbstractCommand {
	/**
	 * @var \stdClass
	 */
	protected $data;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var Organisation|null
	 */
	protected $organisation;

	/**
	 * CreateProblemCommand constructor.
	 *
	 * @param \stdClass $data
	 * @param User $user
	 * @param Organisation|null $organistion
	 */
	public function __construct( \stdClass $data, User $user, ?Organisation $organistion = null ) {
		$this->data         = $data;
		$this->user         = $user;
		$this->organisation = $organistion;
	}

	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return $this->data;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return Organisation|null
	 */
	public function getOrganisation(): ?Organisation {
		return $this->organisation;
	}

}