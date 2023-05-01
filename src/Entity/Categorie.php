<?php

namespace App\Entity;
use App\Repository\CategorieRepository;
use App\Entity\Vehicule;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\PersisterHelper;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['categorie'])]
    private ?int $idCategorie = null;

    #[ORM\Column(length:255)]
    #[Assert\Choice(choices: ['moyenne', 'haute'], message:"Type must be either moyenne or haute")]
    #[Groups(['categorie'])]
    private ?string $type = null;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"matricule is required")]
    #[Groups(['categorie'])]
    private ?string $matricule  = null;

    
       /**
     * Get the formatted matricule (first letter uppercase, others lowercase)
     *
     * @return string|null
     */
    public function getFormattedMatricule(): ?string
    {
        if ($this->matricule === null) {
            return null;
        }

        return ucfirst(strtolower($this->matricule));
    }
    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"marque is required")]
    #[Groups(['categorie'])]
    private ?string $marque = null;

    

    

    
    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }



   
}
