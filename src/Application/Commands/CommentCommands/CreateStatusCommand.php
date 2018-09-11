<?php

namespace DevPledge\Application\Commands\CommentCommands;


use DevPledge\Domain\Organisation;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreateCommentCommand
 * @package DevPledge\Application\Commands
 */
class CreateStatusCommand extends AbstractCommand {


	/**
	 * @var string
	 */
	protected $statusComment;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var Organisation|null
	 */
	protected $organisation;
	/**
	 * @var \stdClass
	 */
	protected $data;

	/**
	 * CreateStatusCommand constructor.
	 *
	 * @param \stdClass $data
	 * @param User $user
	 * @param Organisation|null $organisation
	 */
	public function __construct( \stdClass $data, User $user, ?Organisation $organisation = null ) {
		$this->data         = $data;
		$this->user         = $user;
		$this->organisation = $organisation;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}


	/**
	 * @return \stdClass
	 */
	public function getData(): \stdClass {
		return $this->data;
	}

	/**
	 * @return Organisation|null
	 */
	public function getOrganisation(): ?Organisation {
		return $this->organisation;
	}

}