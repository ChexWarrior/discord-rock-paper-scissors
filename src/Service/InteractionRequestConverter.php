<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\InteractionRequest;
use App\Enum\InteractionType;

/**
 * Converts incoming interaction requests into InteractionRequest DTOs
 * @package App\Service
 */
class InteractionRequestConverter
{
    public static function convert(array $interactionData): InteractionRequest
    {
        $id = $interactionData['id'] ?? null;
        $applicationId = $interactionData['application_id'] ?? null;
        $type = isset($interactionData['type']) ? InteractionType::tryFrom($interactionData['type']) : null;
        $data = $interactionData['data'] ?? null;
        $guildId = $interactionData['guild_id'] ?? null;
        $channelId = $interactionData['channel_id'] ?? null;
        $guildMember = $interactionData['guild_member'] ?? null;
        $user = $interactionData['user'] ?? null;
        $token = $interactionData['token'] ?? null;
        $message = $interactionData['message'] ?? null;
        $appPermissions = $interactionData['app_permissions'] ?? null;

        if (empty($id) || empty($applicationId) || empty($type) || empty($token)) {
            throw new \UnexpectedValueException('Interaction is missing a required value!');
        }

        return new InteractionRequest($id, $applicationId, $type, $data, $guildId, $channelId, $guildMember, $user, $token, $message, $appPermissions);
    }
}
