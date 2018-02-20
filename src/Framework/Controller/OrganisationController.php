<?php

namespace DevPledge\Framework\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use DevPledge\Application\Repository\Organisation\OrganisationRepository;

class OrganisationController
{

    /**
     * @var OrganisationRepository
     */
    private $organisationRepository;

    /**
     * OrganisationController constructor.
     * @param OrganisationRepository $organisationRepository
     */
    public function __construct(OrganisationRepository $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function getOrganisation(Request $req, Response $res)
    {
        $organisationId = $req->getParam('id');
        if ($organisationId === null) {
            return $res->withJson([
                'Missing ID'
            ], 400);
        }

        $organisation = $this->organisationRepository->getOrganisation($organisationId);
        if ($organisation === null) {
            return $res->withJson([
                'Organisation not found'
            ], 404);
        }

        return $res->withJson($organisation);
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function getOrganisations(Request $req, Response $res)
    {
        $filters = $req->getParams([
            'id',
            'firstName',
            'lastName',
            'email',
        ]);

        $organisations = $this->organisationRepository->searchOrganisations($filters);

        return $res->withJson($organisations);
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function patchOrganisation(Request $req, Response $res)
    {
        $organisationId = $req->getParam('id');
        if ($organisationId === null) {
            return $res->withJson([
                'Missing ID'
            ], 400);
        }

        $organisation = $this->organisationRepository->getOrganisation($organisationId);
        if ($organisation === null) {
            return $res->withJson([
                'OrganisationController not found'
            ], 404);
        }

        $body = $req->getParsedBody();

        // todo : set organisation values from body

        $organisation = $this->organisationRepository->saveOrganisation($organisation);

        return $res->withJson($organisation);
    }

}