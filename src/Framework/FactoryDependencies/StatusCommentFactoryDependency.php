<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\StatusCommentFactory;
use DevPledge\Domain\StatusComment;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class StatusCommentFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class StatusCommentFactoryDependency extends AbstractFactoryDependency {
	/**
	 * StatusCommentFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( StatusCommentFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return StatusCommentFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new StatusCommentFactory( StatusComment::class, 'status', 'comment_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return StatusCommentFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}