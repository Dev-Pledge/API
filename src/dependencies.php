<?php
// DIC configuration

use DevPledge\Framework\Services\ServiceProvider;

$container = $app->getContainer();

$provider = new ServiceProvider();
$provider->provide($container);
