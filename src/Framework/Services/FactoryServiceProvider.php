<?php

namespace DevPledge\Framework\Services;


use DevPledge\Application\Factory\OrganisationFactory;
use Psr\Container\ContainerInterface;
use TomWright\Database\ExtendedPDO\ExtendedPDO;
use DevPledge\Application\Repository\Organisation\OrganisationMySQLRepository;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;

class FactoryServiceProvider {

	public function provide( ContainerInterface $c ) {
		$c[ OrganisationFactory::class ] = function ( $c ) {
			return new OrganisationFactory();
		};
	}

}