<?php

namespace App\Service;

use App\Repository\User\UserRepositoryInterface;
use App\DTO\User\UserCreateDTO;
use App\DTO\User\UserUpdateDTO;
use App\Model\User;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserCreateDTO $dto): User
    {
        // Aqui você pode adicionar regras de negócio, validações, etc
        return $this->userRepository->create($dto);
    }

    public function updateUser(User $user, UserUpdateDTO $dto): User
    {
        return $this->userRepository->update($user, $dto);
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function getUserById(string $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }
}
