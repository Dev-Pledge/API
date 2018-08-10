<?php


namespace DevPledge\Framework\RepositoryDependencies\Problem;


use DevPledge\Application\Repository\PledgeRepository;
use DevPledge\Framework\FactoryDependencies\PledgeFactoryDependency;
use DevPledge\Framework\ServiceProviders\AdapterServiceProvider;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use Slim\Container;

/**
 * Class PledgeRepositoryDependency
 * @package DevPledge\Framework\RepositoryDependencies\Problem
 */
class PledgeRepositoryDependency extends AbstractRepositoryDependency {

	public function __construct() {
		parent::__construct( PledgeRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PledgeRepository
	 */
	public function __invoke( Container $container ) {
		return new PledgeRepository( AdapterServiceProvider::getService(), PledgeFactoryDependency::getFactory() );
	}

	/**
	 * @return PledgeRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}