<?php


namespace DevPledge\Application\Mapper;


class Mapper
{

    /**
     * @param Mappable $mappable
     * @return \stdClass
     */
    public function toMap(Mappable $mappable): \stdClass
    {
        return $mappable->toMap();
    }

}