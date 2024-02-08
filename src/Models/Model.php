<?php

declare(strict_types=1);

namespace Personio\Models;

/**
 * Class Model
 *
 * @package Personio
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string status
 */
class Model
{
    /**
     * @var array
     */
    protected array $attributes = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $attribute => $item) {
            $this->attributes[$attribute] = $item['value'];
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get(string $key): mixed
    {
        return $this->attributes[$key];
    }
}