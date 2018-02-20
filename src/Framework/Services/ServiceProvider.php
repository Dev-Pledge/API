<?php

namespace DevPledge\Framework\Services;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use TomWright\JSON\JSON;

class ServiceProvider {

	/**
	 * @var ControllerServiceProvider
	 */
	private $controllerServiceProvider;

	/**
	 * @var DatabaseServiceProvider
	 */
	private $databaseServiceProvider;

	/**
	 * @var RepositoryServiceProvider
	 */
	private $repositoryServiceProvider;

	/**
	 * @var JWTServiceProvider
	 */
	private $jwtServiceProvider;

	/**
	 * @var FactoryServiceProvider
	 */
	private $factoryServiceProvider;

	public function __construct() {
		$this->controllerServiceProvider = new ControllerServiceProvider();
		$this->databaseServiceProvider   = new DatabaseServiceProvider();
		$this->repositoryServiceProvider = new RepositoryServiceProvider();
		$this->jwtServiceProvider        = new JWTServiceProvider();
		$this->factoryServiceProvider    = new FactoryServiceProvider();
	}

	public function provide( ContainerInterface $container ) {
		// monolog
		$container['logger'] = function ( $c ) {
			$settings = $c->get( 'settings' )['logger'];
			$logger   = new Logger( $settings['name'] );
			$logger->pushProcessor( new UidProcessor() );
			$logger->pushHandler( new StreamHandler( $settings['path'], $settings['level'] ) );

			return $logger;
		};

		// view renderer
		$container['renderer'] = function ( $c ) {
			$settings = $c->get( 'settings' )['renderer'];

			return new PhpRenderer( $settings['template_path'] );
		};

		// monolog
		$container['logger'] = function ( $c ) {
			$settings = $c->get( 'settings' )['logger'];
			$logger   = new Logger( $settings['name'] );
			$logger->pushProcessor( new UidProcessor() );
			$logger->pushHandler( new StreamHandler( $settings['path'], $settings['level'] ) );

			return $logger;
		};

		$container[ JSON::class ] = function ( $c ) {
			return new JSON();
		};

		$this->databaseServiceProvider->provide( $container );
		$this->jwtServiceProvider->provide( $container );
		$this->repositoryServiceProvider->provide( $container );
		$this->controllerServiceProvider->provide( $container );
		$this->factoryServiceProvider->provide( $container );
	}

}