<?php

namespace App\Repository\DecibelReading;

use App\Model\DecibelReading;
use App\DTO\DecibelReading\DecibelReadingCreateDTO;
use App\DTO\DecibelReading\DecibelReadingUpdateDTO;

interface DecibelReadingRepositoryInterface
{
    public function create(DecibelReadingCreateDTO $dto): DecibelReading;
    public function update(DecibelReading $reading, DecibelReadingUpdateDTO $dto): DecibelReading;
    public function delete(DecibelReading $reading): void;
    public function findById(string $id): ?DecibelReading;
    public function findByChurch(string $churchId): array;
    public function findByUser(string $userId): array;
}
