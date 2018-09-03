<?php

namespace DevPledge\Framework\RepositoryDependencies\Comment;


use DevPledge\Application\Repository\CommentRepository;
use DevPledge\Framework\FactoryDependencies\CommentFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class CommentRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies\Comment
 */
class CommentRepositoryDependency extends AbstractRepositoryDependency {
	/**
	 * CommentRepositoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( CommentRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return CommentRepository
	 */
	public function __invoke( Container $container ) {
		return new CommentRepository( AdapterServiceProvider::getService(), CommentFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return CommentRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}

}