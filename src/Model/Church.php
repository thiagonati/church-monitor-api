<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\ChurchRepository")]
#[ORM\Table(name: "churches")]
class Church
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "UUID")]
    private string $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $address;

    #[ORM\Column(type: "decimal", precision: 10, scale: 8, nullable: true)]
    private ?float $latitude;

    #[ORM\Column(type: "decimal", precision: 11, scale: 8, nullable: true)]
    private ?float $longitude;

    #[ORM\OneToMany(mappedBy: "church", targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: "church", targetEntity: DecibelReading::class)]
    private Collection $readings;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->readings = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
    public function setAddress(?string $address): self
    {
        $this->address = $address;
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

    public function getUsers(): Collection
    {
        return $this->users;
    }
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }
        return $this;
    }

    public function getReadings(): Collection
    {
        return $this->readings;
    }
    public function addReading(DecibelReading $reading): self
    {
        if (!$this->readings->contains($reading)) {
            $this->readings[] = $reading;
        }
        return $this;
    }
}
