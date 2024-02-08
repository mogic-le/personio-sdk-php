# Personio SDK for PHP

This is the official PHP SDK for the Personio API. It provides a simple way to interact with
the Personio REST API.

## Getting started

To get started, you need to install the SDK using composer:

```bash
composer require brnbio/personio-sdk-php
```
    
Then, you can use the SDK to interact with the Personio API:

```php
<?php

require 'vendor/autoload.php';

$api = new Personio\Api([
    'clientId' => 'your-client-id',
    'clientSecret' => 'your-client-secret',
]);

$employees = $api->employees()->get();

```

