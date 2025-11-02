<?php

namespace App\Service;

use App\Repository\DecibelReading\DecibelReadingRepositoryInterface;
use App\DTO\DecibelReading\DecibelReadingCreateDTO;
use App\DTO\DecibelReading\DecibelReadingUpdateDTO;
use App\Model\DecibelReading;

class DecibelReadingService
{
    private DecibelReadingRepositoryInterface $readingRepository;

    public function __construct(DecibelReadingRepositoryInterface $readingRepository)
    {
        $this->readingRepository = $readingRepository;
    }

    public function createReading(DecibelReadingCreateDTO $dto): DecibelReading
    {
        // Aqui você pode validar se o decibel está dentro de limites, por ex:
        if ($dto->decibels < 0) {
            throw new \Exception("Decibéis não podem ser negativos.");
        }

        return $this->readingRepository->create($dto);
    }

    public function updateReading(DecibelReading $reading, DecibelReadingUpdateDTO $dto): DecibelReading
    {
        return $this->readingRepository->update($reading, $dto);
    }

    public function deleteReading(DecibelReading $reading): void
    {
        $this->readingRepository->delete($reading);
    }

    public function getReadingsByChurch(string $churchId): array
    {
        return $this->readingRepository->findByChurch($churchId);
    }

    public function getReadingsByUser(string $userId): array
    {
        return $this->readingRepository->findByUser($userId);
    }
}
