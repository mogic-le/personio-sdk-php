<?php

declare(strict_types=1);

namespace Personio\Services;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Personio\Models\Employee;

/**
 * Class EmployeesService
 *
 * @package Personio\Services
 */
class EmployeesService extends Service
{
    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function get(): Collection
    {
        $employees = collect();
        foreach ($this->client->get('company/employees') as $employee) {
            $employees->push(new Employee($employee['attributes']));
        }

        return $employees;
    }

    /**
     * @param int $id
     * @return Employee
     * @throws GuzzleException
     */
    public function find(int $id): Employee
    {
        $data = $this->client->get('company/employees/' . $id);

        return new Employee($data['attributes']);
    }
}