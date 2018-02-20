<?php

namespace DevPledge\Application\Security\JWT;


class Token
{

    /**
     * @var \stdClass
     */
    private $data;

    /**
     * Token constructor.
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * @return \stdClass
     */
    public function getData()
    {
        return $this->data;
    }

}