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

	/**
	 * MysqlPDODuplicationException constructor.
	 *
	 * @param \PDOException $PDOException
	 * @param array|null $map
	 */
	public function __construct( \PDOException $PDOException, array $map = null, \Closure $closure = null ) {

		$this->PDOException = $PDOException;
		$this->map          = $map;
		$this->closure      = $closure;
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
					call_user_func_array( $this->closure, [ $this ] );

				}

			}

		}


		return $this->PDOException->getMessage();
	}
}