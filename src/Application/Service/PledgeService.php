<?php


namespace DevPledge\Application\Service;


use DevPledge\Application\Events\CreatedDomainEvent;
use DevPledge\Application\Events\DeletedDomainEvent;
use DevPledge\Application\Events\UpdatedDomainEvent;
use DevPledge\Application\Factory\PledgeFactory;
use DevPledge\Application\Repository\PledgeRepository;
use DevPledge\Domain\Payment;
use DevPledge\Domain\Pledge;
use DevPledge\Domain\Pledges;
use DevPledge\Framework\Adapter\Where;
use DevPledge\Framework\Adapter\Wheres;
use DevPledge\Integrations\Command\Dispatch;

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

		Dispatch::event( new CreatedDomainEvent( $pledge, $pledge->getProblemId() ) );

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

		$pledge = $this->repo->update( $pledge );

		Dispatch::event( new UpdatedDomainEvent( $pledge, $pledge->getProblemId() ) );

		return $pledge;
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
		$pledge  = $this->read( $pledgeId );
		$deleted = $this->repo->delete( $pledgeId );
		if ( $deleted ) {
			Dispatch::event( new DeletedDomainEvent( $pledge ) );
		}

		return $deleted;
	}

	/**
	 * @param string $problemId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function getPledgeCountFromByProblemId( string $problemId ): int {
		return $this->repo->countAllInAllColumn( $problemId );
	}

	/**
	 * @param string $problemId
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function getPledgeValueByProblemId( string $problemId ): float {
		return $this->repo->sumInAllColumnCurrency( $problemId );
	}

	/**
	 * @param string $problemId
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	public function getLastFivePledges( string $problemId ): ?array {
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

	/**
	 * @param string $userId
	 *
	 * @return Pledges
	 * @throws \DevPledge\Application\Factory\FactoryException
	 */
	public function getUserPledges( string $userId ): Pledges {
		$pledges = $this->repo->readAllWhere( new Wheres( [ new Where( 'user_id', $userId ) ] ) );
		if ( $pledges ) {
			return new Pledges( $pledges );
		}

		return new Pledges( [] );
	}

	/**
	 * @param string $userId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function getUserPledgesCount( string $userId ):int {
		return $this->repo->countAllWhere( new Wheres( [ new Where( 'user_id', $userId ) ] ) );
	}
}