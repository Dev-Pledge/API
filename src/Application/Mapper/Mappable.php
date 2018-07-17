<?php


namespace DevPledge\Application\Mapper;


interface Mappable
{

    function toPersistMap(): \stdClass;


}