<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreatePledgePaymentUsingMethodCommand
 * @package DevPledge\Application\Commands
 */
class CreatePledgePaymentUsingMethodCommand extends AbstractCommand {
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $paymentMethodId;
	/**
	 * @var string
	 */
	protected $pledgeId;

	public function __construct( User $user, string $paymentMethodId, string $pledgeId ) {
		$this->user            = $user;
		$this->paymentMethodId = $paymentMethodId;
		$this->pledgeId         = $pledgeId;
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
	public function getPaymentMethodId(): string {
		return $this->paymentMethodId;
	}

	/**
	 * @return string
	 */
	public function getPledgeId(): string {
		return $this->pledgeId;
	}
}