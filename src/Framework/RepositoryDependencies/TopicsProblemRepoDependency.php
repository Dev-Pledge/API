<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 19/07/2018
 * Time: 23:25
 */

namespace DevPledge\Framework\RepositoryDependencies;


use DevPledge\Application\Repository\ProblemRepository;
use DevPledge\Application\Repository\TopicsProblemRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\ProblemFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

/**
 * Class TopicsProblemRepoDependency
 * @package DevPledge\Framework\RepositoryDependencies
 */
class TopicsProblemRepoDependency extends AbstractRepositoryDependency {
	public function __construct() {
		parent::__construct( TopicsProblemRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return ProblemRepository
	 */
	public function __invoke( Container $container ) {
		$factory = ProblemFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );
		return new TopicsProblemRepository( $adaptor, $factory);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return ProblemRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}