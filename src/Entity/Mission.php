<?php

namespace App\Entity;
use App\Repository\MissionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['mission'])]
    private ?int $idMission = null;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"matricule is required")]
    #[Groups(['mission'])]
    private ?string $matricule = null;

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
    #[Assert\Choice(choices:['Inter-Urbain','Intra-Urbain'], message:"Description must be Inter-Urbain or Intra-Urbain")]
    #[Groups(['mission'])]
    private ?string $description = null;


    public function __construct()
    {
        $this->heureDebut = new DateTime();
        $this->heureFin = new DateTime();
    }
    
    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Assert\GreaterThan("now", message:"heureDebut must be after the current date and time")]
    #[Groups(['mission'])]
    private ?DateTime $heureDebut;

    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Assert\GreaterThan("now", message:"heureFin must be after the current date and time")]
    #[Groups(['mission'])]
     private ?DateTime $heureFin;

    public function getIdMission(): ?int
    {
        return $this->idMission;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHeureDebut(): ?DateTime
    {
        return $this->heureDebut;
    }

    public function setHeureDebut( DateTime $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?DateTime
    {
        return $this->heureFin;
    }

    public function setHeureFin( DateTime $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }
    public function getDuree(): ?int
{
    if ($this->heureDebut === null || $this->heureFin === null) {
        return null;
    }
    
    $diff = $this->heureFin->diff($this->heureDebut);
    
    return $diff->h * 60 + $diff->i;
}

public function getDureeMin(): ?int
{
    $duree = $this->getDuree();
    if ($duree === null) {
        return null;
    }
    
    return $duree - 30; // suppose une marge de 30 minutes
}

public function getDureeMax(): ?int
{
    $duree = $this->getDuree();
    if ($duree === null) {
        return null;
    }
    
    return $duree + 30; // suppose une marge de 30 minutes
}

    
}
