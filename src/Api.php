<?php

declare(strict_types=1);

namespace Personio;

use Personio\Services\EmployeesService;

/**
 * Class Api
 *
 * @package Personio
 */
class Api
{
    /**
     * Personio API Client
     * @var Client
     */
    protected Client $client;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * @return EmployeesService
     */
    public function employees(): EmployeesService
    {
        return new EmployeesService($this->client);
    }
}