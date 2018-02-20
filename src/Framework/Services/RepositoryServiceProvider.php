<?php

namespace DevPledge\Framework\Services;


use DevPledge\Application\Factory\OrganisationFactory;
use Psr\Container\ContainerInterface;
use TomWright\Database\ExtendedPDO\ExtendedPDO;
use DevPledge\Application\Repository\Organisation\OrganisationMySQLRepository;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;

class RepositoryServiceProvider {

	public function provide( ContainerInterface $c ) {
		$c[ OrganisationRepository::class ] = function ( $c ) {
			return new OrganisationMySQLRepository( $c->get( ExtendedPDO::class ), $c->get( OrganisationFactory::class ) );
		};
	}

}