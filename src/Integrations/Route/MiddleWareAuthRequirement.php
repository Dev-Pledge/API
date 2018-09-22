<?php

namespace DevPledge\Integrations\Route;

/**
 * Interface MiddleWareAuthRequirement
 * @package DevPledge\Integrations\Route
 */
interface MiddleWareAuthRequirement {
	public function getAuthRequirement(): ?array;
}