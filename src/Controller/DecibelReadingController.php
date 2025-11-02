<?php

namespace App\Controller;

use App\Service\DecibelReadingService;
use App\DTO\DecibelReading\DecibelReadingCreateDTO;
use App\DTO\DecibelReading\DecibelReadingUpdateDTO;
use App\Model\DecibelReading;
use App\Request\DecibelReading\DecibelReadingCreateRequest;
use App\Request\DecibelReading\DecibelReadingUpdateRequest;

class DecibelReadingController
{
    private DecibelReadingService $readingService;

    public function __construct(DecibelReadingService $readingService)
    {
        $this->readingService = $readingService;
    }

    public function create(array $data): DecibelReading
    {
        $dto = new DecibelReadingCreateDTO();

        $request = new DecibelReadingCreateRequest($data);
        $dto = $request->toDTO();

        return $this->readingService->createReading($dto);
    }

    public function update(string $id, array $data): DecibelReading
    {
        $reading = $this->readingService->getReadingsByUser($id)[0] ?? null;
        if (!$reading) {
            throw new \Exception("Leitura não encontrada");
        }

        $request = new DecibelReadingUpdateRequest($data);
        $dto = $request->toDTO();

        return $this->readingService->updateReading($reading, $dto);
    }

    public function findByChurch(string $churchId): array
    {
        return $this->readingService->getReadingsByChurch($churchId);
    }

    public function findByUser(string $userId): array
    {
        return $this->readingService->getReadingsByUser($userId);
    }
}
