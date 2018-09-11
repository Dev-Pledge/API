<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Comment\CommentStatusController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class CommentStatusControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class CommentStatusControllerDependency extends AbstractControllerDependency {
	/**
	 * CommentStatusControllerDependency constructor.
	 */
	public function __construct() {

		parent::__construct( CommentStatusController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return CommentStatusController
	 */
	public function __invoke( Container $container ) {
		return new CommentStatusController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return CommentStatusController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}