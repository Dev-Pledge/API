<?php

namespace DevPledge\Framework\Services;


use Psr\Container\ContainerInterface;
use TomWright\Database\ExtendedPDO\ExtendedPDO;

class DatabaseServiceProvider
{

    public function provide(ContainerInterface $c)
    {
        $c[ExtendedPDO::class] = function ($c) {
            $db = new ExtendedPDO($c->get('settings')['database']['dsn'], $c->get('settings')['database']['user'], $c->get('settings')['database']['pass']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        };
    }

}