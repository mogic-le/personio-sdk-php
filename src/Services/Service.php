<?php

declare(strict_types=1);

namespace Personio\Services;

use Personio\Client;

/**
 * Class Service
 *
 * @package Personio\Services
 */
class Service
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * UserService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}