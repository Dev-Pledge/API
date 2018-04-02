<?php

namespace DevPledge\Application\Services;

use DevPledge\Application\Factory\OrganisationFactory;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;
use DevPledge\Framework\FactoryDependencies\OrganisationFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\OrganisationMySqlRepositoryDependency;
use DevPledge\Integrations\ServiceProvider\AbstractService;
use Slim\Container;

/**
 * Class OrganisationService
 * @package DevPledge\Application\Services
 */
class OrganisationService extends AbstractService {
	/**
	 * @var OrganisationRepository $repo
	 */
	protected $repo;
	/**
	 * @var OrganisationFactory $factory
	 */
	private $factory;

	/**
	 * OrganisationService constructor.
	 */
	public function __construct() {

		parent::__construct( static::class );
	}

	/**
	 * @param string $name
	 *
	 * @return \DevPledge\Domain\Organisation
	 */
	public function create( string $name ) {
		$organisation = $this->factory->create( [
			'name' => $name,
		] );
		$this->repo->saveOrganisation( $organisation );

		return $organisation;
	}


	/**
	 * @param Container $container
	 *
	 * @return mixed
	 */
	public function __invoke( Container $container ) {
		$this->factory = OrganisationFactoryDependency::getFactory();
		$this->repo    = OrganisationMySqlRepositoryDependency::getRepository();

		return $this;
	}

	/**
	 * usually return static::getFromContainer();
	 * @return $this
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}