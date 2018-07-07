<?php

namespace DevPledge\Domain\Role;


class Member implements Role
{

    public function __toString(): string
    {
        return 'member';
    }

}