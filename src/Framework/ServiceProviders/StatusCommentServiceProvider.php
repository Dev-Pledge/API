<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\StatusCommentService;
use DevPledge\Framework\FactoryDependencies\StatusCommentFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Comment\StatusCommentRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use DevPledge\Integrations\ServiceProvider\Services\CacheServiceProvider;
use Slim\Container;

/**
 * Class StatusCommentServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class StatusCommentServiceProvider extends AbstractServiceProvider {
	/**
	 * CommentServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( StatusCommentService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return StatusCommentService
	 */
	public function __invoke( Container $container ) {
		return new StatusCommentService(
			StatusCommentRepositoryDependency::getRepository(),
			StatusCommentFactoryDependency::getFactory(),
			CacheServiceProvider::getService(),
			EntityServiceProvider::getService()
		);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return StatusCommentService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}