<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Application\Service\CurrencyService;
use DevPledge\Domain\CurrencyValue;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;

/**
 * Class FetchProblemPledgesValue
 * @package DevPledge\Domain\Fetcher
 */
class FetchProblemPledgesValue extends CurrencyValue {
	/**
	 * FetchProblemPledgesValue constructor.
	 *
	 * @param string $problemId
	 *
	 * @throws \Exception
	 */
	public function __construct( string $problemId ) {

		$pledgeService = PledgeServiceProvider::getService();

		parent::__construct(
			CurrencyService::SITE_CURRENCY,
			$pledgeService->getPledgeValueByProblemId( $problemId )
		);
	}
}