<?php

namespace DevPledge\Application\Factory;


class ProblemFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|void
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		$this
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'title', 'setTitle' )
			->setMethodToProductObject( 'active_datetime', 'setActiveDatetime', \DateTime::class )
			->setMethodToProductObject( 'deadline_datetime', 'setDeadlineDatetime', \DateTime::class )
			->setMethodToProductObject( 'deleted', 'setDeleted' )
			->setMethodToProductObject( 'specification', 'setSpecification' )
			->setMethodToProductObject( 'description', 'setDescription' );
	}
}