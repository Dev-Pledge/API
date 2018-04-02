<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 11:06
 */

namespace DevPledge\Framework\RepositoryDependencies;


use DevPledge\Application\Repository\Organisation\OrganisationMySQLRepository;
use DevPledge\Framework\FactoryDependencies\OrganisationFactoryDependency;
use DevPledge\Integrations\RepositoryDependency\AbstractRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\Services\ExtendedPDOService;
use Slim\Container;

class OrganisationMySqlRepositoryDependency extends AbstractRepositoryDependency {
	/**
	 * OrganisationMySqlRepositoryDependency constructor.
	 */
	public function __construct() {
		parent::__construct( OrganisationMySQLRepository::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return OrganisationMySQLRepository|mixed
	 */
	public function __invoke( Container $container ) {
		$extendedPDO = ExtendedPDOService::getService();
		$factory     = OrganisationFactoryDependency::getFactory();

		return new OrganisationMySQLRepository( $extendedPDO, $factory );
	}


	/**
	 * @return OrganisationMySQLRepository
	 */
	static public function getRepository() {
		return static::getFromContainer();
	}
}