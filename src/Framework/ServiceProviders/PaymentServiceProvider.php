<?php

namespace DevPledge\Framework\ServiceProviders;


use DevPledge\Application\Service\PaymentService;
use DevPledge\Framework\FactoryDependencies\PaymentFactoryDependency;
use DevPledge\Framework\RepositoryDependencies\Payment\PaymentRepositoryDependency;
use DevPledge\Framework\Settings\StripeSettings;
use DevPledge\Integrations\ServiceProvider\AbstractServiceProvider;
use Omnipay\Omnipay;
use Omnipay\Stripe\Gateway;
use Slim\Container;

/**
 * Class PaymentServiceProvider
 * @package DevPledge\Framework\ServiceProviders
 */
class PaymentServiceProvider extends AbstractServiceProvider {
	/**
	 * PaymentServiceProvider constructor.
	 */
	public function __construct() {
		parent::__construct( PaymentService::class );
	}

	/**
	 * @param Container $container
	 *
	 * @return PaymentService
	 * @throws \Interop\Container\Exception\ContainerException
	 */
	public function __invoke( Container $container ) {
		$stripeSettings = StripeSettings::getSetting();
		/**
		 * @var $gateway Gateway
		 */
		$gateway = Omnipay::create( 'Stripe' );
		$gateway
			->setApiKey( $stripeSettings->getPrivateApiKey() )
			->setTestMode( $stripeSettings->isTestMode() );


		return new PaymentService( PaymentRepositoryDependency::getRepository(), PaymentFactoryDependency::getFactory(), $gateway );
	}

	/**
	 * usually return static::getFromContainer();
	 * @return PaymentService
	 */
	static public function getService() {
		return static::getFromContainer();
	}
}