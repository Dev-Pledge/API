<?php

namespace DevPledge\Framework\ControllerDependencies;


use DevPledge\Framework\Controller\Comment\CommentController;
use DevPledge\Integrations\ControllerDependency\AbstractControllerDependency;
use Slim\Container;

/**
 * Class CommentControllerDependency
 * @package DevPledge\Framework\ControllerDependencies
 */
class CommentControllerDependency extends AbstractControllerDependency {
	/**
	 * CommentControllerDependency constructor.
	 */
	public function __construct() {
		parent::__construct( CommentController::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return CommentController
	 */
	public function __invoke( Container $container ) {
		return new CommentController();
	}

	/**
	 * usually return static::getFromContainer();
	 * @return CommentController
	 */
	static public function getController() {
		return static::getFromContainer();
	}
}