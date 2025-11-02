<?php

namespace App\Service;

use App\Repository\Church\ChurchRepositoryInterface;
use App\DTO\Church\ChurchCreateDTO;
use App\DTO\Church\ChurchUpdateDTO;
use App\Model\Church;

class ChurchService
{
    private ChurchRepositoryInterface $churchRepository;

    public function __construct(ChurchRepositoryInterface $churchRepository)
    {
        $this->churchRepository = $churchRepository;
    }

    public function createChurch(ChurchCreateDTO $dto): Church
    {
        return $this->churchRepository->create($dto);
    }

    public function updateChurch(Church $church, ChurchUpdateDTO $dto): Church
    {
        return $this->churchRepository->update($church, $dto);
    }

    public function deleteChurch(Church $church): void
    {
        $this->churchRepository->delete($church);
    }

    public function getChurchById(string $id): ?Church
    {
        return $this->churchRepository->findById($id);
    }

    public function getAllChurches(): array
    {
        return $this->churchRepository->findAll();
    }
}
