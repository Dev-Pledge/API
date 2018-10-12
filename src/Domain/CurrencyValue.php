<?php

namespace DevPledge\Domain;

use DevPledge\Framework\ServiceProviders\CurrencyServiceProvider;
use Money\Currency;
use Money\Money;

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
	 * @return Money
	 * @throws \Exception
	 */
	public function getMoney() {
		return new Money( (int) ( $this->value * 1000 ), new Currency( $this->currency ) );
	}

	/**
	 * @return float
	 * @throws \Exception
	 */
	public function getInSiteCurrency(): float {
		return CurrencyServiceProvider::getService()->siteSumCurrencyValues( new CurrencyValues( [ $this ] ) );
	}


}