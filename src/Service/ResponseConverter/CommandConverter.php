<?php declare(strict_types=1);

namespace App\Service\ResponseConverter;

use App\DTO\Command;
use App\DTO\CommandOption;

/**
 * Converts raw API response from Discord API into Command DTO objects
 *
 * @package App\Service\ResponseConverter
 */
class CommandConverter
{
    /**
     * Converts raw response body into array of Command DTOs
     *
     * @param array $data
     * @return Command
     */
    public static function convertResponse(array $data): Command
    {
        $commandInfo = [
            'id' => $data['id'],
            'appId' => $data['application_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'options' => [],
        ];

        if (array_key_exists('options', $data)) {
            foreach ($data['options'] as $option) {
                $commandInfo['options'][] = new CommandOption([
                    'name' => $option['name'],
                    'type' => $option['type'],
                    'description' => $option['description'],
                    'required' => $option['required'],
                    'choices' => $option['choices'],
                ]);
            }
        }

        return new Command($commandInfo);
    }
}
