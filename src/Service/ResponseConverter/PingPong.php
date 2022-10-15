<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

/**
 * This service handles the ping request that occasionally comes from Discord
 * @package App\Service
 */
class PingPong
{
    public function pong(): Response
    {
        // TODO: Create enum for interaction callback type
        return new Response(json_encode(['type' => 1]), 200, ['Content-Type' => 'application/json']);
    }
}