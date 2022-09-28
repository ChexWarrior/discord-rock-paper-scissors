<?php declare(strict_types=1);

namespace App\DTO;

use App\Enum\AppCommandOptionType;

/**
 * Represents an Applicaton Command Option in Discord API
 * See: https://discord.com/developers/docs/interactions/application-commands#application-command-object-application-command-option-structure
 * @package App\DTO
 */
class AppCommandOption
{
    public readonly AppCommandOptionType $type;
    public readonly string $name;
    public readonly string $description;
    public readonly bool $required;
    public readonly ?array $choices;

    public function __construct(AppCommandOptionType $type, string $name, string $description, bool $required, array $choices)
    {
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->required = $required;
        /** @var AppCommandOptionChoice[] */
        $this->choices = $choices;
    }

    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'required' => $this->required,
        ];

        $data['choices'] = array_map(fn (AppCommandOptionChoice $c) => $c->toArray(), $this->options);

        return $data;
    }
}