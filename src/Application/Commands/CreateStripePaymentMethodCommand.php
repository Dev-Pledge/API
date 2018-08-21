<?php

namespace DevPledge\Application\Commands;


use DevPledge\Domain\User;
use DevPledge\Integrations\Command\AbstractCommand;

/**
 * Class CreatePaymentMethodCommand
 * @package DevPledge\Application\Commands
 */
class CreateStripePaymentMethodCommand extends AbstractCommand {
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var string
	 */
	protected $token;
	/**
	 * @var string | null
	 */
	protected $organisationId;
	/**
	 * @var string | null
	 */
	protected $name;

	/**
	 * CreateStripePaymentMethodCommand constructor.
	 *
	 * @param null|string $name
	 * @param string $token
	 * @param User $user
	 * @param null|string $organisationId
	 */
	public function __construct( ?string $name, string $token, User $user, ?string $organisationId = null ) {
		$this->token          = $token;
		$this->user           = $user;
		$this->organisationId = $organisationId;
		$this->name           = $name;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->domain;
	}

	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @return null|string
	 */
	public function getOrganisationId(): ?string {
		return $this->organisationId;
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string {
		return $this->name;
	}
}