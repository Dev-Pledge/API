<?php


namespace DevPledge\Application\Mapper;


interface PersistMappable
{

    function toPersistMap(): \stdClass;


}