<?php

namespace DevPledge\Domain;

/**
 * Class CommandPermissionException
 * @package DevPledge\Domain
 */
class CommandPermissionException extends \Exception {
	/**
	 * @param AbstractDomain $domain
	 * @param User $user
	 * @param string $action
	 *
	 * @throws CommandPermissionException
	 */
	static public function tryException( AbstractDomain $domain, User $user, string $action ) {

		if ( ! in_array( $action, Permission::ACTION_TYPES ) ) {
			throw  new static( $action . ' is not available!' );
		}
		$userPermissions       = $user->getPermissions();
		$userId                = $user->getId();
		$domainUserId          = null;
		$domainOrganisationId  = null;
		$domainSolutionGroupId = null;
		if ( is_callable( [ $domain, 'getUserId' ] ) ) {
			$domainUserId = $domain->getUserId();
		}
		if ( is_callable( [ $domain, 'getOrganisationId' ] ) ) {
			$domainOrganisationId = $domain->getOrganisationId();
		}
		if ( is_callable( [ $domain, 'getSolutionGroupId' ] ) ) {
			$domainSolutionGroupId = $domain->getSolutionGroupId();
		}
		if ( ! is_null( $domainOrganisationId ) ) {
			if ( $userPermissions->has( 'organisations', $action, $domainOrganisationId ) ) {
				return;
			}
		}
		if ( ! is_null( $domainSolutionGroupId ) ) {
			if ( $userPermissions->has( 'solution_groups', $action, $domainSolutionGroupId ) ) {
				return;
			}
		}
		if ( ! is_null( $domainOrganisationId ) ) {
			if ( $userPermissions->has( 'super_admins', $action ) ) {
				return;
			}
		}
		if ( ! is_null( $domainUserId ) ) {
			if ( $userId == $domainUserId ) {
				return;
			}
		}
		throw new static( 'Permission Denied!' );

	}
}