<?php

namespace DevPledge\Framework\RepositoryDependencies\Comment;


use DevPledge\Application\Repository\StatusCommentRepository;
use DevPledge\Framework\FactoryDependencies\StatusCommentFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class StatusCommentRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies\Comment
 */
class StatusCommentRepositoryDependency extends AbstractRepositoryDependency {
	/**
	 * StatusCommentRepositoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( StatusCommentRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return StatusCommentRepository
	 */
	public function __invoke( Container $container ) {
		return new StatusCommentRepository( AdapterServiceProvider::getService(), StatusCommentFactoryDependency::getFactory() );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return StatusCommentRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}