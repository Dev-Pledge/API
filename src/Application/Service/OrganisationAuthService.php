<?php


namespace DevPledge\Application\Service;


use DevPledge\Domain\Organisation;
use DevPledge\Integrations\Security\Permissions\Permissions;
use DevPledge\Integrations\Auth\AuthException;
use DevPledge\Integrations\Auth\AuthService;

/**
 * Class OrganisationAuthService
 * @package DevPledge\Application\Service
 */
class OrganisationAuthService
{

    use AuthService;

    /**
     * @param Organisation $organisation
     * @param Permissions $permissions
     * @throws AuthException
     */
    public function checkCreate(Organisation $organisation, Permissions $permissions)
    {
        $this->checkInternal($organisation, $permissions, 'create');
    }

    /**
     * @param Organisation $organisation
     * @param Permissions $permissions
     * @throws AuthException
     */
    public function checkRead(Organisation $organisation, Permissions $permissions)
    {
        $this->checkInternal($organisation, $permissions, 'read');
    }

    /**
     * @param Organisation $organisation
     * @param Permissions $permissions
     * @throws AuthException
     */
    public function checkUpdate(Organisation $organisation, Permissions $permissions)
    {
        $this->checkInternal($organisation, $permissions, 'update');
    }

    /**
     * @param Organisation $organisation
     * @param Permissions $permissions
     * @throws AuthException
     */
    public function checkDelete(Organisation $organisation, Permissions $permissions)
    {
        $this->checkInternal($organisation, $permissions, 'delete');
    }

    /**
     * @param Organisation $organisation
     * @param Permissions $permissions
     * @param string $action
     * @throws AuthException
     */
    private function checkInternal(Organisation $organisation, Permissions $permissions, string $action)
    {
        $p = $this->ensureResourceExists('organisations', $permissions);
        $action = $this->ensureActionExists($action, $p);

        foreach ($action->getRestrictions() as $restriction) {
            switch ($restriction->getName()) {
                case 'organisation':
                    if ($action === 'create') {
                        // create actions shouldn't check against organisationId
                        continue;
                    }
                    if (in_array($organisation->getId(), $restriction->getValues())) {
                        return;
                    }
                    break;
            }
        }

        throw new AuthException("Permission denied for action {$action} on organisation resource");
    }

}