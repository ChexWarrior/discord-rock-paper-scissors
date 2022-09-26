<?php declare(strict_types=1);

namespace App\DTO;

/**
 * Represents information about a command returned from Discord Application
 * Command api endpoint
 *
 * @package App\DTO
 */
class AppCommand
{
    public readonly ?string $id;
    public readonly string $appId;
    public readonly string $name;
    public readonly string $description;
    /** @var ?AppCommandOption[] */
    public readonly ?array $options;

    public function __construct(array $options)
    {
        $this->id ??= $options['id'];
        $this->appId = $options['appId'];
        $this->name = $options['name'];
        $this->description = $options['description'];
        $this->options ??= $options['options'];
    }

    /**
     * Returns this application command as an array 
     */
    public function toArray(): array
    {
        $data = [];
        if (!empty($this->id)) {
            $data['id'] = $this->id;
        }

        $data['appId'] = $this->appId;
        $data['name'] = $this->name;
        $data['description'] = $this->description;

        if (!empty($this->options)) {
            $data['options'] = array_map(fn (AppCommandOption $c) => $c->toArray(), $this->options);
        }

        return $data;
    }
}
