<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Pledges;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchProblemPledgesLastest
 * @package DevPledge\Domain\Fetcher
 */
class FetchProblemPledgesLastest extends Pledges {
	/**
	 * FetchProblemPledgesLastest constructor.
	 *
	 * @param string $problemId
	 */
	public function __construct( string $problemId ) {

		try {
			$pledgeService = PledgeServiceProvider::getService();

			$pledges = $pledgeService->getLastFivePledges( $problemId );
			if ( $pledges ) {
				parent::__construct( $pledges );
			}

		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
		}
	}
}