<?php

declare(strict_types=1);

namespace Personio;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Personio Client
 *
 * @package Personio
 */
class Client
{
    /**
     * @var string
     */
    protected string $baseUri = 'https://api.personio.de';

    /**
     * @var GuzzleClient|null
     */
    protected ?GuzzleClient $client = null;

    /**
     * @var string
     */
    protected string $clientId;

    /**
     * @var string
     */
    protected string $clientSecret;

    /**
     * @var string
     */
    protected string $version = 'v1';

    /**
     * @var string|null
     */
    protected ?string $bearerToken = null;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->clientId = $config['clientId'];
        $this->clientSecret = $config['clientSecret'];
        if (!empty($config['version'])) {
            $this->version = $config['version'];
        }
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     * @throws GuzzleException
     */
    public function get(string $uri, array $options = []): array
    {
        $response = $this->getClient()->get($uri, $options);
        $content = json_decode($response->getBody()->getContents(), true);

        return $content['data'];
    }

    /**
     * @return GuzzleClient
     * @throws GuzzleException
     */
    protected function getClient(): GuzzleClient
    {
        if (is_null($this->client)) {
            $this->client = new GuzzleClient([
                'base_uri' => $this->baseUri . '/' . $this->version . '/',
                'headers'  => [
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getBearerToken(),
                ],
            ]);
        }

        return $this->client;
    }

    /**
     * @return string
     * @throws GuzzleException
     */
    protected function getBearerToken(): string
    {
        if (is_null($this->bearerToken)) {
            $client = new GuzzleClient([
                'base_uri' => $this->baseUri . '/' . $this->version . '/',
                'headers'  => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('auth', [
                'json' => [
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ],
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $this->bearerToken = $data['data']['token'];
        }

        return $this->bearerToken;
    }
}