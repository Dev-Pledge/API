<?php

namespace DevPledge\Framework\ServiceProviders;

use DevPledge\Application\Service\OrganisationAuthService;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Slim\Container;

/**
 * Class OrganisationAuthServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class OrganisationAuthServiceProvider extends AbstractServiceProvider
{

    public function __construct()
    {
        parent::__construct(OrganisationAuthService::class);
    }

    /**
     * @param Container $container
     *
     * @return OrganisationAuthService
     */
    public function __invoke(Container $container)
    {
        return new OrganisationAuthService();
    }

    /**
     * usually return static::getFromContainer();
     * @return OrganisationAuthService
     */
    static public function getService()
    {
        return static::getFromContainer();
    }
}