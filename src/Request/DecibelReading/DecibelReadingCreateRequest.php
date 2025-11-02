<?php

namespace App\Request\DecibelReading;

use App\DTO\DecibelReading\DecibelReadingCreateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class DecibelReadingCreateRequest
{
    public string $userId;
    public string $churchId;
    public float $decibels;
    public ?\DateTime $createdAt = null;

    public function __construct(array $data)
    {
        try {
            v::key('user_id', v::uuid())
                ->key('church_id', v::uuid())
                ->key('decibels', v::floatVal()->min(0))->check($data);

            $this->userId = $data['user_id'];
            $this->churchId = $data['church_id'];
            $this->decibels = $data['decibels'];
            $this->createdAt = isset($data['created_at']) ? new \DateTime($data['created_at']) : new \DateTime();
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): DecibelReadingCreateDTO
    {
        $dto = new DecibelReadingCreateDTO();
        $dto->userId = $this->userId;
        $dto->churchId = $this->churchId;
        $dto->decibels = $this->decibels;
        $dto->createdAt = $this->createdAt;
        return $dto;
    }
}
