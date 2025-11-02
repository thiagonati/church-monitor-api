<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\DecibelReadingRepository")]
#[ORM\Table(name: "decibel_readings")]
class DecibelReading
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "UUID")]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Church::class, inversedBy: "readings")]
    #[ORM\JoinColumn(name: "church_id", referencedColumnName: "id")]
    private Church $church;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "readings")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private User $user;

    #[ORM\Column(type: "integer")]
    private int $decibel;

    #[ORM\Column(type: "decimal", precision: 10, scale: 8, nullable: true)]
    private ?float $latitude;

    #[ORM\Column(type: "decimal", precision: 11, scale: 8, nullable: true)]
    private ?float $longitude;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getChurch(): Church
    {
        return $this->church;
    }
    public function setChurch(Church $church): self
    {
        $this->church = $church;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getDecibel(): int
    {
        return $this->decibel;
    }
    public function setDecibel(int $decibel): self
    {
        $this->decibel = $decibel;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}
