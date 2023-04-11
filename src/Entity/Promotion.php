<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Il faut Ajouter un nom")]
    private ?string $nomP = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Il faut Ajouter un duree")]
    private ?int $DureeP = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Il faut Ajouter un prix avant")]
    private ?int $PrixAvant = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Il faut Ajouter un prix apres")]
    private ?int $PrixApres = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Il faut Ajouter un pourcentage")]
    private ?int $Pourcentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): self
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getDureeP(): ?int
    {
        return $this->DureeP;
    }

    public function setDureeP(int $DureeP): self
    {
        $this->DureeP = $DureeP;

        return $this;
    }

    public function getPrixAvant(): ?int
    {
        return $this->PrixAvant;
    }

    public function setPrixAvant(int $PrixAvant): self
    {
        $this->PrixAvant = $PrixAvant;

        return $this;
    }

    public function getPrixApres(): ?int
    {
        return $this->PrixApres;
    }

    public function setPrixApres(int $PrixApres): self
    {
        $this->PrixApres = $PrixApres;

        return $this;
    }

    public function getPourcentage(): ?int
    {
        return $this->Pourcentage;
    }

    public function setPourcentage(int $Pourcentage): self
    {
        $this->Pourcentage = $Pourcentage;

        return $this;
    }
}
