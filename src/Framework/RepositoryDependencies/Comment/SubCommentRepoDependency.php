<?php

namespace DevPledge\Framework\RepositoryDependencies\Comment;


use DevPledge\Application\Repository\SubCommentRepository;
use DevPledge\Framework\FactoryDependencies\SubCommentFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class SubCommentRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies\Comment
 */
class SubCommentRepoDependency extends AbstractRepositoryDependency {
	/**
	 * SubCommentRepoDependency constructor.
	 */
	public function __construct() {
		parent::__construct( SubCommentRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return SubCommentRepository
	 */
	public function __invoke( Container $container ) {

		return new SubCommentRepository(
			AdapterServiceProvider::getService(),
			SubCommentFactoryDependency::getFactory()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return SubCommentRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}