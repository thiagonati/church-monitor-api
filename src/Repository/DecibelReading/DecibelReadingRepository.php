<?php

namespace App\Repository;

use App\Model\DecibelReading;
use App\DTO\DecibelReading\DecibelReadingCreateDTO;
use App\DTO\DecibelReading\DecibelReadingUpdateDTO;
use App\Repository\DecibelReading\DecibelReadingRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DecibelReadingRepository implements DecibelReadingRepositoryInterface
{
    private EntityManagerInterface $em;
    private string $entity = DecibelReading::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(DecibelReadingCreateDTO $dto): DecibelReading
    {
        $reading = new DecibelReading();

        $user = $this->em->getReference('App\Model\User', $dto->userId);
        $church = $this->em->getReference('App\Model\Church', $dto->churchId);

        // Validação: usuário deve pertencer à igreja
        if ($user->getChurch()?->getId() !== $church->getId()) {
            throw new \Exception("Usuário não pertence a esta igreja.");
        }

        $reading->setUser($user)
            ->setChurch($church)
            ->setDecibel($dto->decibels)
            ->setCreatedAt($dto->createdAt ?? new \DateTimeImmutable());

        $this->em->persist($reading);
        $this->em->flush();

        return $reading;
    }

    public function update(DecibelReading $reading, DecibelReadingUpdateDTO $dto): DecibelReading
    {
        if ($dto->decibels !== null) $reading->setDecibel($dto->decibels);
        if ($dto->createdAt !== null) $reading->setCreatedAt($dto->createdAt);

        $this->em->flush();

        return $reading;
    }

    public function delete(DecibelReading $reading): void
    {
        $this->em->remove($reading);
        $this->em->flush();
    }

    public function findById(string $id): ?DecibelReading
    {
        return $this->em->find($this->entity, $id);
    }

    public function findByChurch(string $churchId): array
    {
        return $this->em->getRepository($this->entity)->findBy(['church' => $churchId]);
    }

    public function findByUser(string $userId): array
    {
        return $this->em->getRepository($this->entity)->findBy(['user' => $userId]);
    }
}
