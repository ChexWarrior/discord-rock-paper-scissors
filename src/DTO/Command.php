<?php declare(strict_types=1);

namespace App\DTO;

/**
 * Represents information about a command returned from Discord Application
 * Command api endpoint
 *
 * @package App\DTO
 */
class Command
{
    public readonly ?string $id;
    public readonly string $appId;
    public readonly string $name;
    public readonly string $description;
    public readonly ?array $choices;

    public function __construct(array $options)
    {
        $this->id ??= $options['id'];
        $this->appId = $options['appId'];
        $this->name = $options['name'];
        $this->description = $options['description'];
        $this->choices ??= $options['choices'];
    }
}
