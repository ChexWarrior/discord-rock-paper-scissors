<?php declare(strict_types=1);

namespace App\Service;

use App\Service\ResponseConverter\AppCommandConverter;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Handles API requests to Discord for handling App command CRUD
 *
 * @package App\Service
 */
class AppCommandApi extends DiscordApi
{
    private readonly array $defaultHeaders;
    private readonly string $url;

    public function __construct(string $botToken, string $applicatonId, string $guildId, HttpClientInterface $client)
    {
        parent::__construct($client);
        $this->url = "applications/$applicatonId/guilds/$guildId/commands";
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bot $botToken"
        ];
    }

    /**
     * Lists application commands registered with guild and returns
     * array of command DTOs
     */
    public function listCommands(): array
    {
        $commands = [];
        // TODO: Handle potential exceptions
        $response = $this->sendRequest(
            url: $this->url,
            options: ['headers' => $this->defaultHeaders]
        );
        $commandData = json_decode(
            json: $response->getContent(),
            associative: true
        );

        foreach ($commandData as $data) {
            $commands[] = AppCommandConverter::convertResponse($data);
        }

        return $commands;
    }

    public function deleteCommand(string $id): bool
    {
        $response = $this->sendRequest(
            url: "$this->url/$id",
            options: ['headers' => $this->defaultHeaders],
            method: 'DELETE'
        );

        if ($response->getStatusCode() === 204) return true;

        return false;
    }
}
