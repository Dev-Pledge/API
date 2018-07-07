<?php
namespace DevPledge\Integrations\Command;


/**
 * Class TestCommandHandler
 * @package DevPledge\Integrations\Command
 */
class TestCommandHandler extends AbstractCommandHandler {

	public function __construct() {
		parent::__construct( TestCommand::class );
	}

	/**
	 * @param $command TestCommand
	 */
	protected function handle( $command ) {
		$word = $command->getTestWord();
		echo $word;
		die;

	}
}