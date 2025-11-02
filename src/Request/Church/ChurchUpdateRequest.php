<?php

namespace App\Request\Church;

use App\DTO\Church\ChurchUpdateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class ChurchUpdateRequest
{
    public ?string $name = null;
    public ?string $address = null;
    public ?float $latitude = null;
    public ?float $longitude = null;

    public function __construct(array $data)
    {
        try {
            if (isset($data['name'])) v::stringType()->length(3, 255)->check($data['name']);
            if (isset($data['latitude'])) v::floatVal()->between(-90, 90)->check($data['latitude']);
            if (isset($data['longitude'])) v::floatVal()->between(-180, 180)->check($data['longitude']);

            $this->name = $data['name'] ?? null;
            $this->address = $data['address'] ?? null;
            $this->latitude = $data['latitude'] ?? null;
            $this->longitude = $data['longitude'] ?? null;
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): ChurchUpdateDTO
    {
        $dto = new ChurchUpdateDTO();
        $dto->name = $this->name;
        $dto->address = $this->address;
        $dto->latitude = $this->latitude;
        $dto->longitude = $this->longitude;
        return $dto;
    }
}
