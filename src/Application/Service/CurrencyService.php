<?php

namespace DevPledge\Application\Service;

use DevPledge\Domain\CurrencyValues;
use FixerExchangeRates\Conversion;

/**
 * Class CurrencyService
 * @package DevPledge\Application\Service
 */
class CurrencyService {

	const SITE_CURRENCY = 'USD';

	/**
	 * @param string $fromCurrency
	 * @param string $toCurrency
	 * @param float $value
	 *
	 * @return float
	 */
	public function get( string $fromCurrency, string $toCurrency, float $value ): float {
		$conversion = new Conversion( $fromCurrency, $toCurrency, $value );

		return $conversion->get();
	}

	/**
	 * @param string $fromCurrency
	 * @param float $value
	 *
	 * @return float
	 */
	public function getSiteCurrency( string $fromCurrency, float $value ): float {
		$conversion = new Conversion( $fromCurrency, static::SITE_CURRENCY, $value );

		return $conversion->get();
	}

	/**
	 * @param CurrencyValues $currencyValues
	 *
	 * @return float
	 */
	public function siteSumCurrencyValues( CurrencyValues $currencyValues ) {
		$currencyValues = $currencyValues->getCurrencyValues();
		$total          = 0;
		foreach ( $currencyValues as $currencyValue ) {
			$total = $total + $this->get( $currencyValue->getCurrency(), static::SITE_CURRENCY, $currencyValue->getValue() );
		}

		return (float) money_format( '%i', $total );
	}

}