<?php

namespace App\Request\DecibelReading;

use App\DTO\DecibelReading\DecibelReadingUpdateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class DecibelReadingUpdateRequest
{
    public ?float $decibels = null;
    public ?\DateTime $createdAt = null;

    public function __construct(array $data)
    {
        try {
            if (isset($data['decibels'])) v::floatVal()->min(0)->check($data['decibels']);
            if (isset($data['created_at'])) $this->createdAt = new \DateTime($data['created_at']);

            $this->decibels = $data['decibels'] ?? null;
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): DecibelReadingUpdateDTO
    {
        $dto = new DecibelReadingUpdateDTO();
        $dto->decibels = $this->decibels;
        $dto->createdAt = $this->createdAt;
        return $dto;
    }
}
