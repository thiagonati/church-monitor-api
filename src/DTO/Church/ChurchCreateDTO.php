<?php

namespace App\DTO\Church;

class ChurchCreateDTO
{
    public string $name;
    public ?string $address = null;
    public ?float $latitude = null;
    public ?float $longitude = null;
}
