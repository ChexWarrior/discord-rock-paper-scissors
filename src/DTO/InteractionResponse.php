<?php declare(strict_types=1);

namespace App\DTO;

use App\Enum\InteractionCallbackType;

/**
 * Represents data in a responset to an interaction
 *
 * @package App\DTO
 */
class InteractionResponse
{
    public function __construct(
        public readonly InteractionCallbackType $type,
        public readonly ?array $data
    ) {}

    public function toArray(): array {
        $arr = [
            'type' => $this->type->value,
        ];

        if (!empty($this->data)) {
            $arr['data'] = $this->data;
        }

        return $arr;
    }
}
