<?php

namespace App\Entity;
use App\Repository\VehiculeRepository;
use DateTime;
use App\Entity\Categorie;
use Doctrine\ORM\Persisters\PersisterHelper;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;







use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['vehicule'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"disponibilité is required")]
    #[Assert\Choice(choices:[0,1], message:"disponibilite must be either 0 or 1")]
    #[Groups(['vehicule'])]
    private ?int $disponibilite = null;


    #[ORM\Column]
    #[Groups(['vehicule'])]
    private ?int $numEntretien = null;

    #[ORM\Column]
    #[Assert\GreaterThan("now", message:"dateEntretien must be after the current date and time")]
    #[Groups(['vehicule'])]
    private ?DateTime $dateEntretien = null;

    #[ORM\Column(length: 255)]
    #[Groups(['vehicule'])]
    private ?string $resEntretien = null;

    
    

   
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getNumEntretien(): ?int
    {
        return $this->numEntretien;
    }

    public function setNumEntretien(int $numEntretien): self
    {
        $this->numEntretien = $numEntretien;

        return $this;
    }

    public function getDateEntretien(): ?DateTime
    {
        return $this->dateEntretien;
    }

    public function setDateEntretien(?DateTime $dateEntretien): self
    {
        $this->dateEntretien = $dateEntretien;
        return $this;
        }
    

    public function getResEntretien(): ?string
    {
        return $this->resEntretien;
    }

    public function setResEntretien(string $resEntretien): self
    {
        $this->resEntretien = $resEntretien;

        return $this;
    }


}
