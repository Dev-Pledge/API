<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class AuthoriseUserCommand
 * @package DevPledge\Application\Commands
 */
class AuthoriseUserCommand extends AbstractCommand {
	const AUTH_TYPES = [ 'create', 'login', 'refresh' ];
	/**
	 * @var string
	 */
	protected $type;
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * AuthoriseUserCommand constructor.
	 *
	 * @param User $user
	 * @param string $type
	 *
	 * @throws \Exception
	 */
	public function __construct( User $user, string $type ) {
		if ( ! in_array( $type, static::AUTH_TYPES ) ) {
			throw new \Exception( $type . ' not in ' . join( ',', static::AUTH_TYPES ) );
		}
		$this->type = $type;
		$this->user = $user;
	}

	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

}