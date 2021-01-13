<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class DataService
 * @package App\Service
 */
class DataService
{
    const BASE_URI = 'https://google.com';
    const MAX_DURATION = 3600;

    private HttpClientInterface $client;

    public function __construct()
    {
        $this->initClient();
    }

    /**
     * @return string
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getItems(): string
    {
        $response = $this->client->request('GET', '/give-me-the-data');
        return $response->getContent();
    }

    private function initClient(): void
    {
        $this->client = HttpClient::create([
            'base_uri' => self::BASE_URI,
            'auth_basic' => null,
            'auth_bearer' => null,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'max_duration' => self::MAX_DURATION,
            'verify_peer' => true,
            'verify_host' => true,
        ]);
    }
}