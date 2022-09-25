<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DiscordAPI
{
    private const BASE_URL = 'https://discord.com/api/v10';
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    protected function sendRequest(string $url, array $options = [], string $method = 'GET'): ResponseInterface
    {
        $fullUrl = self::BASE_URL . "/$url";

        return $this->client->request($method, $fullUrl, $options);
    }
}
