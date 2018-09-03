<?php

namespace DevPledge\Framework\FactoryDependencies;

use DevPledge\Application\Factory\CommentFactory;
use DevPledge\Domain\Comment;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class CommentFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class CommentFactoryDependency extends AbstractFactoryDependency {
	/**
	 * CommentFactoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( CommentFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return CommentFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new CommentFactory( Comment::class, 'comment', 'comment_id' );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return CommentFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}