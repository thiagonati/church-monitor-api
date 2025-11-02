<?php

namespace App\Request\User;

use App\DTO\User\UserCreateDTO;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserCreateRequest
{
    public string $name;
    public string $email;
    public string $password;
    public ?string $role = 'user';
    public ?string $churchId = null;

    public function __construct(array $data)
    {
        try {
            v::key('name', v::stringType()->notEmpty()->length(3, 255))
                ->key('email', v::email())
                ->key('password', v::stringType()->notEmpty()->length(6, 255))
                ->validate($data);

            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->role = $data['role'] ?? 'user';
            $this->churchId = $data['church_id'] ?? null;

            if ($this->churchId !== null) {
                v::uuid()->check($this->churchId);
            }
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    public function toDTO(): UserCreateDTO
    {
        $dto = new UserCreateDTO();
        $dto->name = $this->name;
        $dto->email = $this->email;
        $dto->password = $this->password;
        $dto->role = $this->role;
        $dto->churchId = $this->churchId;
        return $dto;
    }
}
