<?php
$dotEnvFile = '.developmentenv';
if ( isset( $_ENV['production'] ) && $_ENV['production'] == "true" ) {
	$dotEnvFile = '.productionenv';
}

//https://github.com/vlucas/phpdotenv
$dotEnv = new \Dotenv\Dotenv( __DIR__ . '/', $dotEnvFile );
$dotEnv->load();