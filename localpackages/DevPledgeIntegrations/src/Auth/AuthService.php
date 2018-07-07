<?php


namespace DevPledge\Integrations\Auth;


use DevPledge\Integrations\Security\Permissions\Action;
use DevPledge\Integrations\Security\Permissions\Permissions;
use DevPledge\Integrations\Security\Permissions\Resource;

trait AuthService
{

    /**
     * @param string $resource
     * @param Permissions $permissions
     * @return Resource
     * @throws AuthException
     */
    private function ensureResourceExists(string $resource, Permissions $permissions): Resource
    {
        if (!$permissions->hasResource($resource)) {
            throw new AuthException("Resource {$resource} does not exist in permissions");
        }
        return $permissions->getResource($resource);
    }

    /**
     * @param string $action
     * @param Resource $resource
     * @return Action
     * @throws AuthException
     */
    private function ensureActionExists(string $action, Resource $resource): Action
    {
        if (!$resource->hasAction($action)) {
            throw new AuthException("Action {$action} does not exist in resource permissions {$resource->getName()}");
        }
        return $resource->getAction($action);
    }

}