<?php

namespace DevPledge\Domain;

use DevPledge\Framework\ServiceProviders\CurrencyServiceProvider;

/**
 * Class CurrencyValues
 * @package DevPledge\Domain
 */
class CurrencyValues {
	/**
	 * @var CurrencyValue[]
	 */
	protected $currencyValues = [];

	/**
	 * CurrencyValues constructor.
	 *
	 * @param array $currencyValues
	 *
	 * @throws \Exception
	 */
	public function __construct( array $currencyValues ) {
		$this->setCurrencyValues( $currencyValues );
	}

	/**
	 * @param array $currencyValues
	 *
	 * @throws \Exception
	 */
	public function setCurrencyValues( array $currencyValues ) {
		if ( $currencyValues ) {
			foreach ( $currencyValues as $currencyValue ) {
				if ( ! ( $currencyValue instanceof CurrencyValue ) ) {
					throw new \Exception( 'Not Currency Value' );
				}
			}
		}


		$this->currencyValues = $currencyValues;
	}

	/**
	 * @return CurrencyValue[]
	 */
	public function getCurrencyValues() {
		return $this->currencyValues;
	}

	/**
	 * @param CurrencyValue $currencyValue
	 *
	 * @return CurrencyValues
	 */
	public function addCurrencyValue( CurrencyValue $currencyValue ): CurrencyValues {
		$this->currencyValues[] = $currencyValue;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getMoney(): float {
		return CurrencyServiceProvider::getService()->siteSumCurrencyValues( $this->getCurrencyValues() );
	}


}