<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Il faut Ajouter une Description")]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Il faut Ajouter un duree pour l'offre")]
    private ?int $dureeO = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDureeO(): ?int
    {
        return $this->dureeO;
    }

    public function setDureeO(int $dureeO): self
    {
        $this->dureeO = $dureeO;

        return $this;
    }
}
