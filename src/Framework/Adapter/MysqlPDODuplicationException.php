<?php

namespace DevPledge\Framework\Adapter;


/**
 * Class MysqlPDODuplicationException
 * @package DevPledge\Framework\Adapter
 */
class MysqlPDODuplicationException extends \Exception {

	protected $inputMap;
	protected $PDOException;
	protected $map;
	protected $value;
	protected $key;
	protected $closure;
	protected $fallbackClosure;

	/**
	 * MysqlPDODuplicationException constructor.
	 *
	 * @param \PDOException $PDOException
	 * @param array|null $map
	 * @param \Closure|null $closure
	 * @param \Closure|null $fallbackClosure
	 */
	public function __construct( \PDOException $PDOException, array $map = null, \Closure $closure = null, \Closure $fallbackClosure = null ) {

		$this->PDOException    = $PDOException;
		$this->map             = $map;
		$this->closure         = $closure;
		$this->fallbackClosure = $fallbackClosure;
		parent::__construct( $this->getMessageFromPDOException(), $PDOException->getCode() );
	}

	/**
	 * @return string
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	protected function getMessageFromPDOException() {
		$message = $this->PDOException->getMessage();

		if ( strpos( strtolower( $message ), 'duplicate' ) !== false || $this->PDOException->getCode() == 23000 ) {
			$matches = array();
			if ( preg_match( '/\'(.*?)\'/s', $message, $matches ) ) {
				$this->value = trim( $matches[0], "'" );

				if ( ( $this->key = array_search( $this->value, $this->map ) ) && is_callable( $this->closure ) ) {
					return call_user_func_array( $this->closure, [ $this ] );
				} elseif ( isset( $this->fallbackClosure ) ) {
					return call_user_func_array( $this->fallbackClosure, [ $this ] );
				}

			}

		}


		return $this->PDOException->getMessage();
	}
}