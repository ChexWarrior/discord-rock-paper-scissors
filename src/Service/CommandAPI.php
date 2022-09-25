<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Handles API requests to Discord for handling App command CRUD
 *
 * @package App\Service
 */
class CommandAPI extends DiscordAPI
{
    private readonly array $defaultHeaders;
    private readonly string $applicatonId;
    private readonly string $guildId;

    public function __construct(string $botToken, string $applicatonId, string $guildId, HttpClientInterface $client)
    {
        parent::__construct($client);
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bot $botToken"
        ];

        $this->applicatonId = $applicatonId;
        $this->guildId = $guildId;
    }

    public function listCommands() {
        
    }
}
