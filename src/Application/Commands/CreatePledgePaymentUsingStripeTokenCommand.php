<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreatePledgePaymentUsingStripeTokenCommand
 * @package DevPledge\Application\Commands
 */
class CreatePledgePaymentUsingStripeTokenCommand extends AbstractCommand {
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $token;
	/**
	 * @var string
	 */
	protected $pledgeId;

	/**
	 * CreatePledgePaymentUsingStripeTokenCommand constructor.
	 *
	 * @param User $user
	 * @param string $token
	 * @param string $pledgeId
	 */
	public function __construct( User $user, string $token, string $pledgeId ) {
		$this->user     = $user;
		$this->token    = $token;
		$this->pledgeId = $pledgeId;
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
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @return string
	 */
	public function getPledgeId(): string {
		return $this->pledgeId;
	}

}