<?php

namespace DevPledge\Application\Service;

use DevPledge\Domain\CurrencyValues;
use FixerExchangeRates\Conversion;
use Money\Currency;
use Money\Money;

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
		$total          = new Money( 0, new Currency( static::SITE_CURRENCY ) );
		foreach ( $currencyValues as $currencyValue ) {
			$total->add( new Money( (int) ( $this->get( $currencyValue->getCurrency(), static::SITE_CURRENCY, $currencyValue->getValue() ) * 100 ), new Currency( static::SITE_CURRENCY ) ) );
		}

		return (float) money_format( '%i', ( $total->getAmount() / 100 ) );
	}

}