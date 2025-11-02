<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\UserRepository")]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "UUID")]
    private string $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string", unique: true)]
    private string $email;

    #[ORM\Column(type: "string")]
    private string $password;

    #[ORM\Column(type: "string")]
    private string $role = 'user';

    #[ORM\ManyToOne(targetEntity: Church::class, inversedBy: "users")]
    #[ORM\JoinColumn(name: "church_id", referencedColumnName: "id", nullable: true)]
    private ?Church $church = null;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: DecibelReading::class)]
    private Collection $readings;

    public function __construct()
    {
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

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getChurch(): ?Church
    {
        return $this->church;
    }
    public function setChurch(?Church $church): self
    {
        $this->church = $church;
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
