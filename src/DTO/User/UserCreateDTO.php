<?php

namespace App\DTO\User;

class UserCreateDTO
{
    public string $name;
    public string $email;
    public string $password;
    public ?string $role = 'user';
    public ?string $churchId = null;
}
