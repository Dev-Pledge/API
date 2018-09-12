<?php

namespace DevPledge\Application\Factory;

use DevPledge\Domain\Fetcher\FetchCacheUser;
use DevPledge\Domain\Fetcher\FetchRepliesCount;
use DevPledge\Domain\UserDefinedContent;

/**
 * Class SubCommentFactory
 * @package DevPledge\Application\Factory
 */
class SubCommentFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|void
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'parent_comment_id', 'setParentCommentId' )
			->setMethodToProductObject( 'comment', 'setComment', UserDefinedContent::class )
			->setMethodToProductObject( 'user_id', 'setUserId' )
			->setMethodToProductObject( 'user_id', 'setUser', FetchCacheUser::class )
			->setMethodToProductObject( 'entity_id', 'setEntityId' )
			->setMethodToProductObject( 'comment_id', 'setTotalReplies', FetchRepliesCount::class )
			->setMethodToProductObject( 'organisation_id', 'setOrganisationId' );
	}
}