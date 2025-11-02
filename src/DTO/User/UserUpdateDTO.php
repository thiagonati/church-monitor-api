<?php

namespace App\DTO\User;

class UserUpdateDTO
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $role = null;
    public ?string $churchId = null;
}
