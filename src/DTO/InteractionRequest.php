<?php declare(strict_types=1);

namespace App\DTO;

use App\Enum\InteractionType;

/**
 * Holds the data within an interaction request sent from Discord
 *
 * @package App\DTO
 */
class InteractionRequest
{
    public function __construct(
        public readonly string $id,
        public readonly string $applicationId,
        public readonly InteractionType $interactionType,
        public readonly array $data,
        public readonly ?string $guildId,
        public readonly ?string $channelId,
        public readonly ?array $guildMember,
        public readonly ?array $user,
        public readonly string $token,
        public readonly ?array $message,
        public readonly ?string $appPermissions
    ) {}
}
