<?php declare(strict_types=1);

namespace App\Enum;

/**
 * An interaction callback type specifies the type of response to an
 * interaction you are specifying
 *
 * See https://discord.com/developers/docs/interactions/receiving-and-responding#interaction-response-object-interaction-callback-type
 */
enum InteractionCallbackType: int
{
    case PONG = 1;
    case CHANNEL_MESSAGE_WITH_SOURCE = 4;
    case DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE = 5;
    case DEFERRED_UPDATE_MESSAGE = 6;
    case UPDATE_MESSAGE = 7;
    case APPLICATION_COMMAND_AUTOCOMPLETE_RESULT = 8;
    case MODAL = 9;
}
