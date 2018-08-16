<?php


namespace DevPledge\Application\Service;


use DevPledge\Application\Factory\PledgeFactory;
use DevPledge\Application\Repository\PledgeRepository;
use DevPledge\Domain\Payment;
use DevPledge\Domain\Pledge;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;

/**
 * Class PledgeService
 * @package DevPledge\Application\Service
 */
class PledgeService {
	/**
	 * @var PledgeRepository
	 */
	protected $repo;

	/**
	 * @var PledgeFactory $factory
	 */
	protected $factory;
	/**
	 * @var UserService
	 */
	protected $userService;
	/**
	 * @var SolutionService
	 */
	protected $solutionService;
	/**
	 * @var PaymentService
	 */
	protected $paymentService;

	/**
	 * PledgeService constructor.
	 *
	 * @param PledgeRepository $repo
	 * @param PledgeFactory $factory
	 * @param UserService $userService
	 * @param SolutionService $solutionService
	 * @param PaymentService $paymentService
	 */
	public function __construct( PledgeRepository $repo, PledgeFactory $factory, UserService $userService, SolutionService $solutionService, PaymentService $paymentService ) {
		$this->repo            = $repo;
		$this->factory         = $factory;
		$this->userService     = $userService;
		$this->solutionService = $solutionService;
		$this->paymentService  = $paymentService;
	}

	/**
	 * @param \stdClass $data
	 *
	 * @return Pledge
	 * @throws \Exception
	 */
	public function create( \stdClass $data ): Pledge {

		$pledge = $this->factory->create( $data );

		$pledge = $this->repo->createPersist( $pledge );

		return $pledge;
	}


	/**
	 * @param Pledge $pledge
	 * @param \stdClass $rawUpdateData
	 *
	 * @return Pledge
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function update( Pledge $pledge, \stdClass $rawUpdateData ): Pledge {
		$pledge = $this->factory->update( $pledge, $rawUpdateData );

		return $this->repo->update( $pledge );
	}

	/**
	 * @param string $pledgeId
	 *
	 * @return Pledge
	 */
	public function read( string $pledgeId ): Pledge {
		return $this->repo->read( $pledgeId );
	}

	/**
	 * @param string $pledgeId
	 *
	 * @return int|null
	 */
	public function delete( string $pledgeId ): ?int {
		return $this->repo->delete( $pledgeId );
	}

	/**
	 * @param $problemId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function getPledgeCountFromByProblemId( $problemId ): int {
		return $this->repo->countAllInAllColumn( $problemId );
	}

	/**
	 * @param $problemId
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function getPledgeValueByProblemId( $problemId ): float {
		return $this->repo->sumInAllColumnCurrency( $problemId );
	}

	/**
	 * @param $problemId
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	public function getLastFivePledges( $problemId ) {
		return $this->repo->readAllWhere( new Wheres( [ new Where( 'problem_id', $problemId ) ] ), 'created', true, 5 );
	}

	/**
	 * @param string $pledgeId
	 * @param string $token
	 *
	 * @return bool|null
	 * @throws \DevPledge\Domain\PaymentException
	 */
	public function payPledgeWithStripeToken( string $pledgeId, string $token ): bool {
		$pledge = $this->read( $pledgeId );
		if ( ! $pledge->isPersistedDataFound() ) {
			return false;
		}

		return $this->paymentService->stripePayWithToken( $token, $pledge->getCurrencyValue(), function ( $response, ?Payment $payment ) use ( $pledge ) {
			if ( ! is_null( $payment ) ) {
				$pledge->setPaymentId( $payment->getId() );
				$this->update( $pledge, (object) [] );
			}
		} );
	}
}