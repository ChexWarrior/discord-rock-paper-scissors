<?php declare(strict_types=1);

namespace App\Service\ResponseConverter;

use App\DTO\AppCommand;
use App\DTO\AppCommandOption;
use App\DTO\AppCommandOptionChoice;
use App\Enum\AppCommandOptionType;

/**
 * Converts raw API response from Discord API into Command DTO objects
 *
 * @package App\Service\ResponseConverter
 */
class AppCommandConverter
{
    /**
     * Converts raw response body into array of Command DTOs
     *
     * @param array $data
     * @return Command
     */
    public static function convertResponse(array $data): AppCommand
    {
        $options = [];
        if (array_key_exists('options', $data)) {
            foreach ($data['options'] as $option) {
                $choices = array_map(fn(array $c) => new AppCommandOptionChoice($c['name'], $c['value']), $option['choices']);
                $options[] = new AppCommandOption(
                    AppCommandOptionType::from($option['type']),
                    $option['name'],
                    $option['description'],
                    isset($option['required']) ? $option['required'] : false,
                    $choices
                );
            }
        }

        return new AppCommand(
            $data['id'],
            $data['application_id'],
            $data['name'],
            $data['description'],
            $options
        );
    }
}
