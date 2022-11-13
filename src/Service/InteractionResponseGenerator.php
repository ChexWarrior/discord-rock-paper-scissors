<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\InteractionResponse;
use App\Enum\InteractionCallbackType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Creates and sends responses to discord interactions
 * See: https://discord.com/developers/docs/interactions/receiving-and-responding#responding-to-an-interaction
 * @package App\Service
 */
class InteractionResponseGenerator
{
    public static function generate(InteractionCallbackType $type, array $data) {
        $interactionResponse = new InteractionResponse($type, $data);

        return new JsonResponse(
            $interactionResponse->toArray(),
            200
        );
    }
}
