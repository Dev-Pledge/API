<?php

namespace DevPledge\Application\Factory;


/**
 * Class FollowFactory
 * @package DevPledge\Application\Factory
 */
class FollowFactory extends AbstractFactoryDualUuid {
	/**
	 * @return AbstractFactory|FollowFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this;
	}
}