<?php

namespace App\Repository\User;

use App\Model\User;
use App\DTO\User\UserCreateDTO;
use App\DTO\User\UserUpdateDTO;
use App\Repository\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;
    private string $entity = User::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(UserCreateDTO $dto): User
    {
        $user = new User();
        $user->setName($dto->name)
            ->setEmail($dto->email)
            ->setPassword(password_hash($dto->password, PASSWORD_BCRYPT))
            ->setRole($dto->role ?? 'user');

        if ($dto->churchId) {
            $church = $this->em->getReference('App\Model\Church', $dto->churchId);
            $user->setChurch($church);
        }

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function update(User $user, UserUpdateDTO $dto): User
    {
        if ($dto->name) $user->setName($dto->name);
        if ($dto->email) $user->setEmail($dto->email);
        if ($dto->password) $user->setPassword(password_hash($dto->password, PASSWORD_BCRYPT));
        if ($dto->role) $user->setRole($dto->role);
        if ($dto->churchId) {
            $church = $this->em->getReference('App\Model\Church', $dto->churchId);
            $user->setChurch($church);
        }

        $this->em->flush();
        return $user;
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function findById(string $id): ?User
    {
        return $this->em->find($this->entity, $id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->em->getRepository($this->entity)->findOneBy(['email' => $email]);
    }

    public function findAll(): array
    {
        return $this->em->getRepository($this->entity)->findAll();
    }
}
