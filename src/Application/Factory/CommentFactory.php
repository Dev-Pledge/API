<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\UserDefinedContent;

class CommentFactory extends AbstractFactory {

	/**
	 * @return AbstractFactory|void
	 * @throws FactoryException
	 */
	function setMethodsToProductObject() {
		$this->setMethodToProductObject( 'parent_comment_id', 'setParentCommentId' )
		     ->setMethodToProductObject( 'comment', 'setComment', UserDefinedContent::class )
		     ->setMethodToProductObject( 'entity_id', 'setEntityId' )
		     ->setMethodToProductObject( 'user_id', 'setUserId' )
		     ->setMethodToProductObject( 'organisation_id', 'setOrganisationId' );
	}
}