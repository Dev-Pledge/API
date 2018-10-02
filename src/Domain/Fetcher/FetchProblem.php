<?php

namespace DevPledge\Domain\Fetcher;


use DevPledge\Domain\Problem;
use DevPledge\Framework\ServiceProviders\ProblemServiceProvider;
use DevPledge\Integrations\Sentry;

/**
 * Class FetchProblem
 * @package DevPledge\Domain\Fetcher
 */
class FetchProblem extends Problem {
	/**
	 * FetchProblem constructor.
	 *
	 * @param $problemId
	 */
	public function __construct( $problemId ) {

		parent::__construct( 'problem' );

		try {
			$problemService = ProblemServiceProvider::getService();
			$problem        = $problemService->read( $problemId );
			$this
				->setUuid( $problem->getUuid() )
				->setOrganisationId( $problem->getOrganisationId() )
				->setUserId( $problem->getUserId() )
				->setCreated( $problem->getCreated() )
				->setModified( $problem->getModified() )
				->setDeleted( $problem->isDeleted() )
				->setActiveDatetime( $problem->getActiveDatetime() )
				->setDeadlineDatetime( $problem->getDeadlineDatetime() )
				->setDescription( $problem->getDescription() )
				->setPersistedDataFound( $problem->isPersistedDataFound() );

		} catch ( \Exception | \TypeError $exception ) {

			Sentry::get()->captureException( $exception );
		}
	}
}