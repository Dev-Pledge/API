<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Solutions;
use DevPledge\Framework\ServiceProviders\SolutionServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchProblemSolutions
 * @package DevPledge\Domain\Fetcher
 */
class FetchProblemSolutions extends Solutions {
	/**
	 * FetchProblemSolutions constructor.
	 *
	 * @param $problemId
	 *
	 * @throws \Exception
	 */
	public function __construct( $problemId ) {

		try {
			$solutionService = SolutionServiceProvider::getService();
			$solutions       = $solutionService->readAll( $problemId );
			parent::__construct( $solutions->getSolutions() );

		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
		}
	}
}