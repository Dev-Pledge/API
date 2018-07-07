<?php

namespace DevPledge\Application\Factory;
use DevPledge\Domain\Organisation;

/**
 * Class OrganisationFactory
 * @package DevPledge\Application\Factory
 *
 * The factory is just a way of converting a data array into a desired object.
 * I also like to use it when "updating" an object from a data array too.
 */
class OrganisationFactory {
	/**
	 * @param $data
	 *
	 * @return Organisation
	 */
	public function create( $data ):Organisation {
		$organisation =  new Organisation();

        if (array_key_exists('name', $data)) {
            $organisation->setName($data['name']);
        }

		return $organisation;
	}

    /**
     * @param Organisation $organisation
     * @param array $data
     *
     * @return Organisation
     */
	public function update( Organisation $organisation, array $data ):Organisation {
	    if (array_key_exists('name', $data)) {
	        $organisation->setName($data['name']);
        }

		return $organisation;
	}

}