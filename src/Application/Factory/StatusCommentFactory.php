<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Fetcher\FetchCacheUser;
use DevPledge\Domain\Topics;
use DevPledge\Domain\UserDefinedContent;

/**
 * Class StatusCommentFactory
 * @package DevPledge\Application\Factory
 */
class StatusCommentFactory extends AbstractFactory {
	/**
	 * @return AbstractFactory|StatusCommentFactory
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'parent_comment_id', 'setParentCommentId' )
			->setMethodToProductObject( 'comment', 'setComment', UserDefinedContent::class )
			->setMethodToProductObject( 'user_id', 'setUser', FetchCacheUser::class )
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'entity_id', 'setEntityId' )
			->setMethodToProductObject( 'topics', 'setTopics', Topics::class )
			->setMethodToProductObject( 'organisation_id', 'setOrganisationId' );
	}
}