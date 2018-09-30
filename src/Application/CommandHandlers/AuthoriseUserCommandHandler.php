<?php


namespace DevPledge\Application\CommandHandlers;


use DevPledge\Application\Commands\AuthoriseUserCommand;
use DevPledge\Framework\ServiceProviders\UserServiceProvider;
use DevPledge\Integrations\Command\AbstractCommandHandler;

/**
 * Class AuthoriseUserCommandHandler
 * @package DevPledge\Application\CommandHandlers
 */
class AuthoriseUserCommandHandler extends AbstractCommandHandler {
	/**
	 * AuthoriseUserCommandHandler constructor.
	 */
	public function __construct() {
		parent::__construct( AuthoriseUserCommand::class );
	}


	/**
	 * @param $command AuthoriseUserCommand
	 *
	 * @return \DevPledge\Application\Service\TokenString
	 */
	protected function handle( $command ) {
		$tokenString = UserServiceProvider::getService()->getNewTokenStringFromUser( $command->getUser() );

		/**
		 * You can log these here if needed
		 */

		return $tokenString;
	}
}