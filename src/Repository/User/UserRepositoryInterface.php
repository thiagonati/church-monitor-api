<?php

namespace App\Repository\User;

use App\Model\User;
use App\DTO\User\UserCreateDTO;
use App\DTO\User\UserUpdateDTO;

interface UserRepositoryInterface
{
    public function create(UserCreateDTO $dto): User;
    public function update(User $user, UserUpdateDTO $dto): User;
    public function delete(User $user): void;
    public function findById(string $id): ?User;
    public function findByEmail(string $email): ?User;
    public function findAll(): array;
}
