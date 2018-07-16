<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 15/07/2018
 * Time: 22:54
 */

namespace DevPledge\Application\Factory;


class ProblemFactory extends AbstractFactory {

	/**
	 * @return $this
	 */
	function setMethodsToProductObject() {
		$this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'title', 'setTitle' )
			->setMethodToProductObject( 'description', 'setDescription' );
	}
}