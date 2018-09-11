<?php

namespace DevPledge\Framework\RepositoryDependencies\Comment;


use DevPledge\Application\Repository\TopicsCommentRepository;
use DevPledge\Framework\FactoryDependencies\CommentFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class TopicsCommentRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies\Comment
 */
class TopicsCommentRepoDependency extends AbstractRepositoryDependency {
	/**
	 * TopicsCommentRepoDependency constructor.
	 */
	public function __construct() {
		Parent::__construct( TopicsCommentRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return TopicsCommentRepository
	 */
	public function __invoke( Container $container ) {
		return new TopicsCommentRepository(
			AdapterServiceProvider::getService(),
			CommentFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return TopicsCommentRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}