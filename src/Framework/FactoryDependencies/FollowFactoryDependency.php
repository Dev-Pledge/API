<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/07/2018
 * Time: 22:29
 */

namespace DevPledge\Framework\FactoryDependencies;


use DevPledge\Application\Factory\FollowFactory;
use DevPledge\Domain\Follow;
use DevPledge\Integrations\FactoryDependency\AbstractFactoryDependency;
use Slim\Container;

/**
 * Class FollowFactoryDependency
 * @package DevPledge\Framework\FactoryDependencies
 */
class FollowFactoryDependency extends AbstractFactoryDependency {

	public function __construct() {
		parent::__construct( FollowFactory::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return FollowFactory
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function __invoke( Container $container ) {
		return new FollowFactory( Follow::class, 'follow' ,['user_id','entity_id']);
	}

	/**
	 * usually return static::getFromContainer();
	 * @return FollowFactory
	 */
	static public function getFactory() {
		return static::getFromContainer();
	}
}