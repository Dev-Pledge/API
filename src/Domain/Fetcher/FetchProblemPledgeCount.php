<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Count;
use DevPledge\Framework\ServiceProviders\PledgeServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchProblemPledgeCount
 * @package DevPledge\Domain\Fetcher
 */
class FetchProblemPledgeCount extends Count {
	/**
	 * FetchProblemPledgeCount constructor.
	 *
	 * @param string $problemId
	 */
	public function __construct( string $problemId ) {
		try {
			parent::__construct( PledgeServiceProvider::getService()->getPledgeCountFromByProblemId( $problemId ) );
		} catch ( \Exception | \TypeError $exception ) {
			Sentry::get()->captureException( $exception );
		}
	}
}