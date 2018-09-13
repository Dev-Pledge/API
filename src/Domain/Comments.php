<?php

namespace DevPledge\Domain;

/**
 * Class Comments
 * @package DevComment\Domain
 */
class Comments extends AbstractDomain {
	/**
	 * @var Comment[]
	 */
	protected $comments = [];

	/**
	 * Comments constructor.
	 *
	 * @param array $comments
	 * @param User|null $user
	 *
	 * @throws \Exception
	 */
	public function __construct( array $comments ) {
		$this->setComments( $comments );
	}

	/**
	 * @param array $comments
	 *
	 * @return $this
	 * @throws \Exception
	 */
	public function setComments( array $comments ): Comments {
		foreach ( $comments as $comment ) {
			if ( ! $comment instanceof Comment ) {
				ob_start();
				var_dump( $comment );
				$x = ob_get_clean();
				throw new \Exception( 'Not Comment ' . $x );
			}
		}
		$this->comments = $comments;

		return $this;
	}

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		$data = new \stdClass();

		$data->comments = [];
		if ( $this->comments ) {
			foreach ( $this->comments as $comment ) {
				$data->comments[] = $comment->toPersistMap();
			}
		}

		return $data;
	}

	public function toAPIMap(): \stdClass {
		$data = new \stdClass();

		$data->comments = [];
		if ( $this->comments ) {
			foreach ( $this->comments as $comment ) {
				$data->comments[] = $comment->toPublicAPIMap();
			}
		}

		return $data;
	}

	/**
	 * @return array
	 */
	public function toAPIMapArray(): array {
		return $this->toAPIMap()->comments;
	}

	/**
	 * @return Comment[]
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * @return int
	 */
	public function countComments(): int {
		return count( $this->comments );
	}

}