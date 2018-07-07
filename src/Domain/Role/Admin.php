<?php

namespace DevPledge\Domain\Role;


class Admin implements Role
{

    public function __toString(): string
    {
        return 'admin';
    }

}