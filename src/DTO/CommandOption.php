<?php declare(strict_types=1);

namespace App\DTO;

use App\Enum\CommandOptionType;

/**
 * Represents an Applicaton Command Option in Discord API
 * See: https://discord.com/developers/docs/interactions/application-commands#application-command-object-application-command-option-structure
 * @package App\DTO
 */
class CommandOption
{
    public readonly CommandOptionType $type;
    public readonly string $name;
    public readonly string $description;
    public readonly bool $required;
    public readonly ?array $choices;

    public function __construct(array $options)
    {
        $this->type = CommandOptionType::from($options['type']);
        $this->name = $options['name'];
        $this->description = $options['description'];
        $this->required = $options['required'] ?? false;
        $this->choices ??= $options['choices'];
    }

    public function toJson(): string
    {
        $data = [
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'required' => $this->required,
        ];

        if (!empty($this->choices)) {
            $data['choices'] = $this->choices;
        }

        return json_encode($data);
    }
}