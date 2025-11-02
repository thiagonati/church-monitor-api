<?php

namespace App\DTO\DecibelReading;

class DecibelReadingCreateDTO
{
    public string $userId;
    public string $churchId;
    public float $decibels;
    public ?\DateTimeImmutable $createdAt = null;
}
