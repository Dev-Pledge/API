<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 11:06
 */

namespace DevPledge\Framework\RepositoryDependencies;


use DevPledge\Application\Mapper\Mapper;
use DevPledge\Application\Repository\OrganisationRepository;
use DevPledge\Framework\Adapter\MysqlAdapter;
use DevPledge\Framework\FactoryDependencies\OrganisationFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOServiceProvider;
use Slim\Container;

class OrganisationRepositoryDependency extends AbstractRepositoryDependency {
	/**
	 * OrganisationRepositoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( OrganisationRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return OrganisationRepository
	 */
	public function __invoke( Container $container ) {
		$factory = OrganisationFactoryDependency::getFactory();
		$adaptor = new MysqlAdapter( ExtendedPDOServiceProvider::getService() );
		$mapper  = new Mapper();
		return new OrganisationRepository( $adaptor, $mapper, $factory );
	}


	/**
	 * @return OrganisationRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}