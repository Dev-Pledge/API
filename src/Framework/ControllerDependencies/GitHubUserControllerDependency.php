<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 16/10/2018
 * Time: 20:01
 */

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\User\GitHubUserController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class GitHubUserControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class GitHubUserControllerDependency extends AbstractControllerDependency {
	/**
	 * GitHubUserControllerDependency constructor
	 */
	public function __construct() {
		parent::__construct( GitHubUserController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return GitHubUserController
	 */
	public function __invoke( Container $container ) {
		return new GitHubUserController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return GitHubUserController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}