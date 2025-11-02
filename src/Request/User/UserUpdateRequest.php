<?php

namespace App\Request\User;

use App\DTO\User\UserUpdateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserUpdateRequest
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $role = null;
    public ?string $churchId = null;

    public function __construct(array $data)
    {
        try {
            if (isset($data['name'])) v::stringType()->length(3, 255)->check($data['name']);
            if (isset($data['email'])) v::email()->check($data['email']);
            if (isset($data['password'])) v::stringType()->length(6, 255)->check($data['password']);
            if (isset($data['role'])) v::stringType()->in(['user', 'admin'])->check($data['role']);
            if (isset($data['church_id'])) v::uuid()->check($data['church_id']);

            $this->name = $data['name'] ?? null;
            $this->email = $data['email'] ?? null;
            $this->password = $data['password'] ?? null;
            $this->role = $data['role'] ?? null;
            $this->churchId = $data['church_id'] ?? null;
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): UserUpdateDTO
    {
        $dto = new UserUpdateDTO();
        $dto->name = $this->name;
        $dto->email = $this->email;
        $dto->password = $this->password;
        $dto->role = $this->role;
        $dto->churchId = $this->churchId;
        return $dto;
    }
}
