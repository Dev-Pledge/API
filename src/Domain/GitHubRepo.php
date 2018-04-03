<?php

namespace DevPledge\Domain;


class GitHubRepo extends Repo
{
    /**
     * @var string
     */
    protected static $baseUrl = 'https://github.com';
}