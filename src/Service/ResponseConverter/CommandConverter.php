<?php declare(strict_types=1);

namespace App\Service\ResponseConverter;

use App\DTO\Command;

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
        $options = [
            'id' => $data['id'],
            'appId' => $data['application_id'],
            'name' => $data['name'],
            'description' => $data['description'],
        ];

        if (array_key_exists('choices', $data)) {
            foreach ($data['choices'] as $choice) {
                $options['data'][] = [
                    'name' => $choice['name'],
                    'value' => $choice['value'],
                ];
            }
        }

        return new Command($options);
    }
}
