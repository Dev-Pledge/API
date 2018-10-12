<?php

namespace DevPledge\Domain;

use DevPledge\Framework\ServiceProviders\CurrencyServiceProvider;

/**
 * Class CurrencyValue
 * @package DevPledge\Domain
 */
class CurrencyValue {
	/**
	 * @var string
	 */
	protected $currency;
	/**
	 * @var float
	 */
	protected $value;

	/**
	 * CurrencyValue constructor.
	 *
	 * @param string $currency
	 * @param float $value
	 */
	public function __construct( string $currency, float $value ) {

		$this->currency = $currency;
		$this->value    = $value;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string {
		return $this->currency;
	}

	/**
	 * @return float
	 */
	public function getValue(): float {
		return $this->value;
	}

	/**
	 * @return float
	 * @throws \Exception
	 */
	public function getMoney(): float {
		return CurrencyServiceProvider::getService()->siteSumCurrencyValues( new CurrencyValues( [ $this ] ) );
	}


}