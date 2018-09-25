<?php

namespace DevPledge\Domain;

/**
 * Class UserDefinedContent
 * @package DevPledge\Domain
 */
class UserDefinedContent {
	/**
	 * @var null|string
	 */
	protected $content;

	/**
	 * UserDefinedContent constructor.
	 *
	 * @param null|string $content
	 */
	public function __construct( ?string $content = null ) {
		$this->content = $content;
	}

	/**
	 * @return null|string
	 */
	public function getContent() {

		return static::makeLinks( $this->strip() );
	}

	/**
	 * @return string
	 */
	public function strip() {
		$content = str_replace( [ "<br>", "<br />" ], "\r\n", $this->content );
		$content = strip_tags( $content, '<img>' );

		return $content;
	}

	public function setContent( string $content ) {
		$this->content = $content;
	}

	/**
	 * @param $s
	 *
	 * @return string
	 */
	public static function makeLinks( $s ) {
		return preg_replace( '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s );
	}
}