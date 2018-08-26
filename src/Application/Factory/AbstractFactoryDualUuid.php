<?php

namespace DevPledge\Application\Factory;


use DevPledge\Uuid\DualUuid;

/**
 * Class AbstractFactoryDualUuid
 * @package DevPledge\Application\Factory
 */
abstract class AbstractFactoryDualUuid extends AbstractFactory {
	/**
	 * @var string
	 */
	protected $uuidClass = DualUuid::class;
	/**
	 * @var string
	 */
	protected $setUuidMethod = 'setDualUuid';
}