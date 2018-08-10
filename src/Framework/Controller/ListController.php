<?php

namespace DevPledge\Framework\Controller;


use DevPledge\Domain\Topics;
use DevPledge\Framework\ServiceProviders\TopicServiceProvider;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ListController
 * @package DevPledge\Framework\Controller
 */
class ListController extends AbstractController {
	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function getTopics( Request $request, Response $response ) {
		$topicService = TopicServiceProvider::getService();

		return $response->withJson( [
			'topics' => ( new Topics( $topicService->getTopics() ) )->toAPIMapArray()
		] );
	}
}