<?php

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\SubCommentFactory;
use DevPledge\Domain\SubComment;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class SubCommentFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class SubCommentFactoryDependency extends AbstractFactoryDependency {
	/**
	 * SubCommentFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( SubCommentFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return SubCommentFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new SubCommentFactory( SubComment::class, 'comment', 'comment_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return SubCommentFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}