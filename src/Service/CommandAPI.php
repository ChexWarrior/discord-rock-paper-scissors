<?php declare(strict_types=1);

namespace App\Service;

use App\Service\ResponseConverter\CommandConverter;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Handles API requests to Discord for handling App command CRUD
 *
 * @package App\Service
 */
class CommandAPI extends DiscordAPI
{
    private readonly array $defaultHeaders;
    private readonly string $url;

    public function __construct(string $botToken, string $applicatonId, string $guildId, HttpClientInterface $client)
    {
        parent::__construct($client);
        $this->url = "applications/$applicationId/guilds/$guildId";
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bot $botToken"
        ];
    }

    /**
     * Lists application commands registered with guild and returns
     * array of command DTOs
     *
     * @return string
     */
    public function listCommands(): array
    {
        $commands = [];
        // TODO: Handle potential exceptions
        $response = $this->sendRequest(url: $this->url, options: $this->defaultHeaders);
        $commandData = json_decode(json: $response->getContent(), associative: true);

        foreach ($commandData as $data) {
            $commands[] = CommandConverter::convertResponse($data);
        }

        return $commands;
    }
}
