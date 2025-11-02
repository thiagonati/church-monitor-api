<?php

namespace App\Controller;

use App\Service\UserService;
use App\Model\User;
use App\Request\User\UserUpdateRequest;
use App\Request\User\UserCreateRequest;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(array $data): User
    {
        $resquest = new UserCreateRequest($data);
        $dto = $resquest->toDTO();

        return $this->userService->createUser($dto);
    }

    public function update(string $id, array $data): User
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            throw new \Exception("Usuário não encontrado");
        }

        $resquest = new UserUpdateRequest($data);
        $dto = $resquest->toDTO();
        return $this->userService->updateUser($user, $dto);
    }

    public function findById(string $id): ?User
    {
        return $this->userService->getUserById($id);
    }

    public function findAll(): array
    {
        return $this->userService->getAllUsers();
    }

    public function delete(string $id): void
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            throw new \Exception("Usuário não encontrado");
        }
        $this->userService->deleteUser($user);
    }
}
