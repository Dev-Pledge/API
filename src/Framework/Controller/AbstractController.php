<?php


namespace DevPledge\Framework\Controller;


use DevPledge\Application\Factory\FactoryException;
use DevPledge\Application\Repository\AbstractRepository;
use DevPledge\Domain\AbstractDomain;
use DevPledge\Domain\User;
use DevPledge\Framework\FactoryDependencies\UserFactoryDependency;
use DevPledge\Integrations\Security\JWT\Token;
use Slim\Http\Request;

class AbstractController {
	/**
	 * @param Request $request
	 *
	 * @return \stdClass
	 */
	protected function getStdClassFromRequest( Request $request ): \stdClass {
		$data = new \stdClass();

		if ( is_array( $request->getParsedBody() ) ) {
			$data = (object) $request->getParsedBody();
		}

		return $data;
	}

	/**
	 * @param AbstractRepository $repo
	 * @param $id
	 *
	 * @return AbstractDomain
	 */
	protected function readFromRepo( AbstractRepository $repo, $id ): ?AbstractDomain {
		try {
			return $repo->read( $id );
		} catch ( \Error $error ) {
			return null;
		}
	}

	/**
	 * @param Request $request
	 *
	 * @return User|null
	 */
	protected function getUserFromRequest( Request $request ): ?User {
		try {
			return UserFactoryDependency::getFactory()->createFromToken( $request->getAttribute( Token::class) );
		} catch ( FactoryException $exception ) {
			return null;
		}
	}



}