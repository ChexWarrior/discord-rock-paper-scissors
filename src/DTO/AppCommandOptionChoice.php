<?php declare(strict_types=1);

namespace App\DTO;

/**
 * See: https://discord.com/developers/docs/interactions/application-commands#application-command-object-application-command-option-choice-structure
 * @package App\DTO
 */
class AppCommandOptionChoice
{
    public readonly string $name;
    public readonly mixed $value;

    public function __construct(string $name, mixed $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}