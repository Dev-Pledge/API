<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 25/03/2018
 * Time: 13:59
 */

namespace DevPledge\Integrations\Extrapolate;

/**
 * Class Extrapolate
 * @package DevPledge\Integrations\Extrapolate
 */
class Extrapolate {

	protected static $cachedExtrapolationsDir;

	/**
	 * @param AbstractExtrapolateForContainer[] $extrapolations
	 */
	public static function extrapolate( array $extrapolations ) {

		if ( count( $extrapolations ) ) {
			foreach ( $extrapolations as $ext ) {
				if ( $ext instanceof AbstractExtrapolate ) {
					call_user_func( $ext );
				}
			}
		}
	}

	/**
	 * @return bool|string
	 */
	public static function getCachedExtrapolationsDir() {
		return static::$cachedExtrapolationsDir ?? false;
	}

	/**
	 * @param string $cachedExtrapolationsDir
	 */
	public static function setCachedExtrapolationsDir( $cachedExtrapolationsDir ): void {
		static::$cachedExtrapolationsDir = rtrim( $cachedExtrapolationsDir, '/' );
	}
}