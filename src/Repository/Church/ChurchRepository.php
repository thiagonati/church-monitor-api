<?php

namespace App\Repository;

use App\Model\Church;
use App\DTO\Church\ChurchCreateDTO;
use App\DTO\Church\ChurchUpdateDTO;
use App\Repository\Church\ChurchRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ChurchRepository implements ChurchRepositoryInterface
{
    private EntityManagerInterface $em;
    private string $entity = Church::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(ChurchCreateDTO $dto): Church
    {
        $church = new Church();
        $church->setName($dto->name)
            ->setAddress($dto->address)
            ->setLatitude($dto->latitude)
            ->setLongitude($dto->longitude);

        $this->em->persist($church);
        $this->em->flush();

        return $church;
    }

    public function update(Church $church, ChurchUpdateDTO $dto): Church
    {
        if ($dto->name) $church->setName($dto->name);
        if ($dto->address) $church->setAddress($dto->address);
        if ($dto->latitude) $church->setLatitude($dto->latitude);
        if ($dto->longitude) $church->setLongitude($dto->longitude);

        $this->em->flush();
        return $church;
    }

    public function delete(Church $church): void
    {
        $this->em->remove($church);
        $this->em->flush();
    }

    public function findById(string $id): ?Church
    {
        return $this->em->find($this->entity, $id);
    }

    public function findAll(): array
    {
        return $this->em->getRepository($this->entity)->findAll();
    }
}
