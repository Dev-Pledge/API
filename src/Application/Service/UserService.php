<?php

namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\UserFactory;
use DevPledge\Uuid\Uuid;
use Predis\Client;

/**
 * Class UserService
 * @package DevPledge\Application\Service
 */
class UserService {

	/**
	 * @var UserFactory $factory
	 */
	private $factory;
	/**
	 * @var Client
	 */
	private $cacheClient;

	/**
	 * UserService constructor.
	 *
	 * @param UserFactory $factory
	 * @param Client $cacheClient
	 */
	public function __construct( UserFactory $factory, Client $cacheClient ) {

		$this->factory     = $factory;
		$this->cacheClient = $cacheClient;
	}

	/**
	 * @param string $username
	 *
	 * @return \DevPledge\Domain\User
	 */
	public function getByUsername( string $username ) {
		$data = $this->cacheClient->get( 'usrn::' . $username );

		return $this->factory->create( $data );

	}

	public function getByUserId( string $userId ) {
		$uuid = new Uuid( $userId );
		$data = [];
		if ( $uuid->getPrefix() == 'usr' ) {
			$data = $this->cacheClient->get( $uuid->toString() );
		}

		return $this->factory->create( $data );

	}

}