<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 30/03/2018
 * Time: 00:33
 */

namespace DevPledge\Integrations\Command;


class TestCommand extends AbstractCommand {
	protected $testWord;

	public function __construct( $testWord ) {
		$this->testWord = $testWord;
	}

	public function getTestWord() {
		return $this->testWord;
	}
}