<?php

namespace DevPledge\Domain;

/**
 * Class FeedEntity
 * @package DevPledge\Domain
 */
class FeedEntity {
	/**
	 * @var AbstractDomain
	 */
	protected $domain;
	/**
	 * @var AbstractDomain | null
	 */
	protected $parentDomain;
	/**
	 * @var string
	 */
	protected $function;

	public function __construct( string $function, AbstractDomain $domain, ?AbstractDomain $parentDomain = null ) {
		$this->domain       = $domain;
		$this->parentDomain = $parentDomain;
		$this->function     = $function;
	}

	/**
	 * @return AbstractDomain | CommentsTrait
	 */
	public function getDomain(): AbstractDomain {
		return $this->domain;
	}

	/**
	 * @return AbstractDomain | null | CommentsTrait
	 */
	public function getParentDomain(): ?AbstractDomain {
		return $this->parentDomain;
	}

	/**
	 * @return string
	 */
	public function getFunction(): string {
		return $this->function;
	}

	/**
	 * @return \stdClass
	 */
	public function toAPIMap(): \stdClass {
		$data             = [];
		$data['function'] = $this->getFunction();
		if ( in_array( CommentsTrait::class, class_uses( $this->getDomain() ) ) ) {

			$data['entity'] = [
				'type' => $this->getDomain()->getUuid()->getEntity(),
				'data' => $this->getDomain()->toAPIMapWithComments()
			];
		} else {
			$data['entity'] = [
				'type' => $this->getDomain()->getUuid()->getEntity(),
				'data' => $this->getDomain()->toPublicAPIMap()
			];
		}

		if ( $this->getParentDomain() instanceof AbstractDomain ) {
			if ( in_array( CommentsTrait::class, class_uses( $this->getParentDomain() ) ) ) {
				$data['parent_entity'] = [
					'type' => $this->getParentDomain()->getUuid()->getEntity(),
					'data' => $this->getParentDomain()->toAPIMapWithComments()
				];
			} else {
				$data['parent_entity'] = [
					'type' => $this->getParentDomain()->getUuid()->getEntity(),
					'data' => $this->getParentDomain()->toPublicAPIMap()
				];
			}
		} else {
			$data['parent_entity'] = null;
		}


		return (object) $data;
	}

}