<?php

namespace App\Request\Church;

use App\DTO\Church\ChurchCreateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class ChurchCreateRequest
{
    public string $name;
    public ?string $address = null;
    public ?float $latitude = null;
    public ?float $longitude = null;

    public function __construct(array $data)
    {
        try {
            v::key('name', v::stringType()->notEmpty()->length(3, 255))->check($data);

            $this->name = $data['name'];
            $this->address = $data['address'] ?? null;

            if (isset($data['latitude'])) v::floatVal()->between(-90, 90)->check($data['latitude']);
            if (isset($data['longitude'])) v::floatVal()->between(-180, 180)->check($data['longitude']);

            $this->latitude = $data['latitude'] ?? null;
            $this->longitude = $data['longitude'] ?? null;
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): ChurchCreateDTO
    {
        $dto = new ChurchCreateDTO();
        $dto->name = $this->name;
        $dto->address = $this->address;
        $dto->latitude = $this->latitude;
        $dto->longitude = $this->longitude;
        return $dto;
    }
}
