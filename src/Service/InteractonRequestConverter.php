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
        $id ??= $interactionData['id'];
        $applicationId ??= $interactionData['application_id'];
        $type = $interactionData['type'] ?? InteractionType::tryFrom($interactionData['type']);
        $data ??= $interactionData['data'];
        $guildId ??= $interactionData['guild_id'];
        $channelId ??= $interactionData['channel_id'];
        $guildMember ??= $interactionData['guild_member'];
        $user ??= $interactionData['user'];
        $token ??= $interactionData['token'];
        $message ??= $interactionData['message'];
        $appPermissions ??= $interactionData['app_permissions'];

        if (empty($id) || empty($applicationId) || empty($type) || empty($token)) {
            throw new \UnexpectedValueException('Interaction is missing a required value!');
        }

        return new InteractionRequest($id, $applicationId, $type, $data, $guildId, $channelId, $guildMember, $user, $token, $message, $appPermissions);
    }
}
