<?php declare(strict_types=1);

namespace App\Service;

use App\Enum\InteractionCallbackType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * This service handles the ping request that occasionally comes from Discord
 * @package App\Service
 */
class PingPong
{
    public function pong(): JsonResponse
    {
        // TODO: Create enum for interaction callback type
        return new JsonResponse(
            ['type' => InteractionCallbackType::PONG->value],
            200
        );
    }
}