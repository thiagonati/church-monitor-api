<?php

namespace App\Repository\Church;

use App\Model\Church;
use App\DTO\Church\ChurchCreateDTO;
use App\DTO\Church\ChurchUpdateDTO;

interface ChurchRepositoryInterface
{
    public function create(ChurchCreateDTO $dto): Church;
    public function update(Church $church, ChurchUpdateDTO $dto): Church;
    public function delete(Church $church): void;
    public function findById(string $id): ?Church;
    public function findAll(): array;
}
