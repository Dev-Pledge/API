<?php

namespace DevPledge\Framework\Controller;


use DevPledge\Application\Commands\CreateOrganisationCommand;
use DevPledge\Application\Service\OrganisationAuthService;
use DevPledge\Application\Service\OrganisationService;
use DevPledge\Domain\User;
use DevPledge\Integrations\Command\Dispatch;
use DevPledge\Integrations\Security\JWT\Token;
use DevPledge\Integrations\Security\Permissions\Permissions;
use DevPledge\Integrations\Service\AuthException;
use DevPledge\Uuid\Uuid;
use Slim\Http\Request;
use Slim\Http\Response;

class OrganisationController
{

    /**
     * @var OrganisationService
     */
    private $organisationService;

    /**
     * @var OrganisationAuthService
     */
    private $organisationAuthService;

    /**
     * OrganisationController constructor.
     * @param OrganisationService $organisationService
     * @param OrganisationAuthService $organisationAuthService
     */
    public function __construct(
        OrganisationService $organisationService,
        OrganisationAuthService $organisationAuthService
    ) {
        $this->organisationService = $organisationService;
        $this->organisationAuthService = $organisationAuthService;
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

        $organisation = $this->organisationService->read($organisationId);
        if ($organisation === null) {
            return $res->withJson([
                'Organisation not found'
            ], 404);
        }

        try {
            $this->organisationAuthService->checkRead($organisation,
                $req->getAttribute(Token::class, new Permissions()));
        } catch (AuthException $e) {
            return $res->withJson([
                $e->getMessage(),
            ], 403);
        }

        return $res->withJson($organisation);
    }

    /**
     * @param Request $req
     * @param Response $res
     *
     * @return Response
     * @throws \Exception
     */
    public function getOrganisations(Request $req, Response $res)
    {
        $filters = $req->getParams([
            'id',
            'firstName',
            'lastName',
            'email',
        ]);

        $organisations = $this->organisationService->readAll($filters);

        foreach ($organisations as $organisation) {
            try {
                $this->organisationAuthService->checkRead($organisation,
                    $req->getAttribute(Token::class, new Permissions()));
            } catch (AuthException $e) {
                return $res->withJson([
                    $e->getMessage(),
                ], 403);
            }
        }

        return $res->withJson($organisations);
    }

    /**
     * @param Request $req
     * @param Response $res
     *
     * @return Response
     * @throws \Exception
     */
    public function patchOrganisation(Request $req, Response $res)
    {
        $organisationId = $req->getParam('id');
        if ($organisationId === null) {
            return $res->withJson([
                'Missing ID'
            ], 400);
        }

        $organisation = $this->organisationService->read($organisationId);
        if ($organisation === null) {
            return $res->withJson([
                'Organisation not found'
            ], 404);
        }

        try {
            $this->organisationAuthService->checkUpdate($organisation,
                $req->getAttribute(Token::class, new Permissions()));
        } catch (AuthException $e) {
            return $res->withJson([
                $e->getMessage(),
            ], 403);
        }

        $data = $req->getParams([
            'name',
        ]);

        $organisation = $this->organisationService->update($organisation, $data);

        return $res->withJson($organisation);
    }

    /**
     * @param Request $req
     * @param Response $res
     *
     * @return Response
     * @throws \DevPledge\Integrations\Command\CommandException
     */
    public function postOrganisation(Request $req, Response $res)
    {
        $body = $req->getParsedBody();
        $userId = $body['user_id'] ?? null;
        if ($userId === null) {
            return $res->withJson([
                'Missing user_id'
            ], 400);
        }

        $name = $body['name'] ?? null;
        if ($name === null) {
            return $res->withJson([
                'Missing name'
            ], 400);
        }

        $userUuid = new Uuid($userId);
        $user = new User(); // TODO: Get user from $userUuid
        $user->setId($userUuid);

        // See CommandHandler\CreateOrganisationHandler
        $command = new CreateOrganisationCommand($user, $name);
        $organisation = Dispatch::command($command);

        try {
            $this->organisationAuthService->checkCreate($organisation,
                $req->getAttribute(Token::class, new Permissions()));
        } catch (AuthException $e) {
            return $res->withJson([
                $e->getMessage(),
            ], 403);
        }

        return $res->withJson($organisation);
    }

}