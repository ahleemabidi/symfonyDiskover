<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FacturerRepository;
use DateTime;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\length;

#[ORM\Entity(repositoryClass: FacturerRepository::class)]
class Facturer
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_facture")]
        private ?int $id_facture;

    #[ORM\Column]
    private ?DateTime $dateFacture;

    #[ORM\Column(length : 255)]
    private ?string $statut;

    #[ORM\Column(length : 255)]
    private ?string $notes;

    

    public function getId_Facture(): ?int
    {
        return $this->id_facture;
    }

    public function getDateFacture(): ?DateTime
    {
        return $this->dateFacture;
    }

    public function setDateFacture(DateTime $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getIdFacture(): ?int
    {
        return $this->id_facture;
    }


 


}