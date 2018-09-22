<?php

namespace DevPledge\Integrations\Route;


class AvailableRoutes {
	/**
	 * @var AvailableRoute[]
	 */
	private static $availableRoutes = [];

	public static function AddRoute( AvailableRoute $availableRoute ) {
		static::$availableRoutes[] = $availableRoute;
	}

	/**
	 * @return AvailableRoute[]
	 */
	public static function get() {
		return static::$availableRoutes;
	}

}