<?php

namespace DevPledge\Framework\Services;


use Psr\Container\ContainerInterface;
use TomWright\JSON\JSON;
use DevPledge\Application\Security\JWT\JWT;

class JWTServiceProvider
{

    public function provide(ContainerInterface $c)
    {
        $c[JWT::class] = function ($c) {
            $secret = $c->get('settings')['security']['jwt']['secret'];
            $algorithm = $c->get('settings')['security']['jwt']['algorithm'];
            $jwt = new JWT($secret, $algorithm, $c->get(JSON::class));

            $ttl = $c->get('settings')['security']['jwt']['ttl'] ?? null;
            $ttr = $c->get('settings')['security']['jwt']['ttr'] ?? null;

            if ($ttl !== null) {
                $jwt->setTimeToLive($ttl);
            }
            if ($ttr !== null) {
                $jwt->setTimeToRefresh($ttr);
            }

            return $jwt;
        };
    }

}