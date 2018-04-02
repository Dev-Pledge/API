<?php

namespace DevPledge\Framework\Controller;


use DevPledge\Application\Command\CreateOrganisationCommand;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Uuid\Uuid;
use League\Tactician\CommandBus;
use Slim\Http\Request;
use Slim\Http\Response;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;

class OrganisationController {

	/**
	 * @var OrganisationRepository
	 */
	private $organisationRepository;

	/**
	 * OrganisationController constructor.
	 *
	 * @param OrganisationRepository $organisationRepository
	 */
	public function __construct( OrganisationRepository $organisationRepository ) {
		$this->organisationRepository = $organisationRepository;
	}

	/**
	 * @param Request $req
	 * @param Response $res
	 * @param CommandBus $bus
	 *
	 * @return Response
	 */
	public function postOrganisation( Request $req, Response $res, CommandBus $bus ) {
		$body   = $req->getParsedBody();
		$userId = $body['user_id'] ?? null;
		if ( $userId === null ) {
			return $res->withJson( [
				'Missing user_id'
			], 400 );
		}

		$name = $body['name'] ?? null;
		if ( $name === null ) {
			return $res->withJson( [
				'Missing name'
			], 400 );
		}

		$userUuid = new Uuid( $userId );
		$user     = new User(); // TODO: Get user from $userUuid

		// See CommandHandler\CreateOrganisationHandler
		$command      = new CreateOrganisationCommand( $user, $name );
		$organisation = Dispatch::command( $command );

		return $res->withJson( $organisation );
	}

	/**
	 * @param Request $req
	 * @param Response $res
	 *
	 * @return Response
	 */
	public function getOrganisation( Request $req, Response $res ) {
		$organisationId = $req->getParam( 'id' );
		if ( $organisationId === null ) {
			return $res->withJson( [
				'Missing ID'
			], 400 );
		}

		$organisation = $this->organisationRepository->getOrganisation( $organisationId );
		if ( $organisation === null ) {
			return $res->withJson( [
				'Organisation not found'
			], 404 );
		}

		return $res->withJson( $organisation );
	}

	/**
	 * @param Request $req
	 * @param Response $res
	 *
	 * @return Response
	 */
	public function getOrganisations( Request $req, Response $res ) {
		$filters = $req->getParams( [
			'id',
			'firstName',
			'lastName',
			'email',
		] );

		$organisations = $this->organisationRepository->searchOrganisations( $filters );

		return $res->withJson( $organisations );
	}

	/**
	 * @param Request $req
	 * @param Response $res
	 *
	 * @return Response
	 */
	public function patchOrganisation( Request $req, Response $res ) {
		$organisationId = $req->getParam( 'id' );
		if ( $organisationId === null ) {
			return $res->withJson( [
				'Missing ID'
			], 400 );
		}

		$organisation = $this->organisationRepository->getOrganisation( $organisationId );
		if ( $organisation === null ) {
			return $res->withJson( [
				'OrganisationController not found'
			], 404 );
		}

		$body = $req->getParsedBody();

		// todo : set organisation values from body

		$organisation = $this->organisationRepository->saveOrganisation( $organisation );

		return $res->withJson( $organisation );
	}

}