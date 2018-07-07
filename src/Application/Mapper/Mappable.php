<?php


namespace DevPledge\Application\Mapper;


interface Mappable
{

    function toMap(): \stdClass;

}