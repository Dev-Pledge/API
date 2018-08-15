<?php
/**
 * Created by PhpStorm.
 * User: johnsaunders
 * Date: 15/08/2018
 * Time: 11:37
 */

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\PledgePaymentService;
use DevPledge\Framework\Settings\StripeSettings;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Omnipay\Omnipay;
use Omnipay\Stripe\Gateway;
use Slim\Container;

/**
 * Class PaymentServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class PledgePaymentServiceProvider extends AbstractServiceProvider {

	public function __construct() {
		parent::__construct( PledgePaymentService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PledgePaymentService
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$stripeSettings = StripeSettings::getSetting();
		/**
		 * @var $gateway Gateway
		 */
		$gateway = Omnipay::create( 'Stripe' );
		$gateway->setApiKey( $stripeSettings->getPrivateApiKey() );

		return new PledgePaymentService( $gateway , PledgeServiceProvider::getService());
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PledgePaymentService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}