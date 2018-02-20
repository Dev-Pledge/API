<?php

namespace DevPledge\Framework\Services;


use Psr\Container\ContainerInterface;
use DevPledge\Framework\Controller\Auth\AuthController;
use DevPledge\Framework\Controller\OrganisationController;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;
use DevPledge\Application\Security\JWT\JWT;

class ControllerServiceProvider
{

    public function provide(ContainerInterface $c)
    {
        $c[AuthController::class] = function ($c) {
            return new AuthController($c->get(JWT::class));
        };

        $c[OrganisationController::class] = function ($c) {
            $repository = $c->get(OrganisationRepository::class);
            return new OrganisationController($repository);
        };
    }

}