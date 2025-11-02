<?php

namespace App\Controller;

use App\Service\ChurchService;
use App\Request\Church\ChurchCreateRequest;
use App\Request\Church\ChurchUpdateRequest;
use App\Model\Church;

class ChurchController
{
    private ChurchService $churchService;

    public function __construct(ChurchService $churchService)
    {
        $this->churchService = $churchService;
    }

    /**
     * Cria uma nova igreja
     */
    public function create(array $data): Church
    {
        // Usa o Request para validar e criar o DTO
        $request = new ChurchCreateRequest($data);
        $dto = $request->toDTO();

        return $this->churchService->createChurch($dto);
    }

    /**
     * Atualiza uma igreja existente
     */
    public function update(string $id, array $data): Church
    {
        $church = $this->churchService->getChurchById($id);
        if (!$church) {
            throw new \Exception("Igreja não encontrada");
        }

        // Usa o Request para validar e criar o DTO
        $request = new ChurchUpdateRequest($data);
        $dto = $request->toDTO();

        return $this->churchService->updateChurch($church, $dto);
    }

    /**
     * Busca igreja pelo ID
     */
    public function findById(string $id): ?Church
    {
        return $this->churchService->getChurchById($id);
    }

    /**
     * Retorna todas as igrejas
     */
    public function findAll(): array
    {
        return $this->churchService->getAllChurches();
    }

    /**
     * Deleta uma igreja
     */
    public function delete(string $id): void
    {
        $church = $this->churchService->getChurchById($id);
        if (!$church) {
            throw new \Exception("Igreja não encontrada");
        }

        $this->churchService->deleteChurch($church);
    }
}
