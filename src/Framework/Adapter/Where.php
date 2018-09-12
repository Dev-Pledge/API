<?php

namespace DevPledge\Framework\Adapter;

/**
 * Class Where
 * @package DevPledge\Framework\Adapter
 */
class Where {
	/**
	 * @var string
	 */
	protected $column;
	/**
	 * @var string
	 */
	protected $value;
	/**
	 * @var bool
	 */
	protected $valueAsColumn = false;
	/**
	 * like ,equals ,more than, less than, more than equal, less than equal
	 * @var string
	 */
	protected $type;

	const TYPE_OPTIONS = [
		'like',
		'equals',
		'more than',
		'less than',
		'more than equal',
		'less than equal',
		'like at start',
		'like at end',
		'not',
		'is null',
		'is not null'
	];

	/**
	 * Where constructor.
	 *
	 * @param string $column
	 * @param string $value
	 * @param string $type
	 */
	public function __construct( string $column, string $value, string $type = 'equals' ) {
		$this->setColumn( $column )->setValue( $value )->setType( $type );
	}

	/**
	 * like ,equals ,more than, less than, more than equal, less than equal,like at start,like at end
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param $type
	 *
	 * @return Where
	 */
	public function setType( $type ): Where {
		if ( in_array( $type, static::TYPE_OPTIONS ) ) {
			$this->type = $type;
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function getColumn(): string {
		return $this->column;
	}

	/**
	 * @param string $column
	 *
	 * @return Where
	 */
	public function setColumn( string $column ): Where {
		$this->column = $column;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue(): string {
		return $this->value;
	}

	/**
	 * @param string $value
	 *
	 * @return Where
	 */
	public function setValue( string $value ): Where {

		$this->value = $value;
		
		return $this;
	}

	/**
	 * @return Where
	 */
	public function equals(): Where {
		return $this->setType( 'equals' );
	}

	/**
	 * @return Where
	 */
	public function like(): Where {
		return $this->setType( 'like' );
	}

	/**
	 * @return Where
	 */
	public function likeAtEnd(): Where {
		return $this->setType( 'like at end' );
	}

	/**
	 * @return Where
	 */
	public function likeAtStart(): Where {
		return $this->setType( 'like at start' );
	}

	/**
	 * @return Where
	 */
	public function moreThan(): Where {
		return $this->setType( 'more than' );
	}

	/**
	 * @return Where
	 */
	public function lessThan(): Where {
		return $this->setType( 'less than' );
	}

	/**
	 * @return Where
	 */
	public function lessThanOrEqual(): Where {
		return $this->setType( 'less than equals' );
	}

	/**
	 * @return Where
	 */
	public function not(): Where {
		return $this->setType( 'not' );
	}

	/**
	 * @return Where
	 */
	public function isNull(): Where {
		return $this->setType( 'is null' );
	}

	/**
	 * @return Where
	 */
	public function isNotNull(): Where {
		return $this->setType( 'is not null' );
	}

	/**
	 * @return Where
	 */
	public function moreThanOrEqual(): Where {
		return $this->setType( 'more than equals' );
	}

	/**
	 * @return Where
	 */
	public function setValueAsColumn(): Where {
		$this->valueAsColumn = true;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isValueAsColumn(): bool {
		return $this->valueAsColumn;
	}
}