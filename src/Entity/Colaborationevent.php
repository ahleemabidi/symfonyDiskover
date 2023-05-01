<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ColaborationeventRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Colaborationevent
 *
 * @ORM\Table(name="colaborationevent")
 * @ORM\Entity
 */
#[ORM\Entity(repositoryClass: ColaborationeventRepository::class)]


class Colaborationevent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idevent = null;
    #[ORM\Column(name: 'NomEvent', type: 'string', length: 255, nullable: false)]
    private $nomevent = null;
    #[ORM\Column(name: 'DateEvent', type: 'date', length: 255, nullable: false)]

    private $dateevent;

    #[ORM\Column(name: 'AdresseEvent', type: 'string', length: 255, nullable: false)]

    private $adresseevent;

     #[ORM\Column(name: 'NbrPlaceVehicule', type: 'integer', length: 255, nullable: false)]

    private $nbrplacevehicule;

    #[ORM\Column(name: 'PrixVehiculeEvent', type: 'integer', length: 255, nullable: false)]

    private $prixvehiculeevent;


    public function getIdEvent(): ?int
    {
        return $this->idevent;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomevent = $nomEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateevent = $dateEvent;

        return $this;
    }

    public function getAdresseEvent(): ?string
    {
        return $this->adresseevent;
    }

    public function setAdresseEvent(string $adresseEvent): self
    {
        $this->adresseevent = $adresseEvent;

        return $this;
    }

    public function getNbrPlaceVehicule(): ?int
    {
        return $this->nbrplacevehicule;
    }

    public function setNbrPlaceVehicule(int $nbrPlaceVehicule): self
    {
        $this->nbrplacevehicule = $nbrPlaceVehicule;

        return $this;
    }

    public function getPrixVehiculeEvent(): ?float
    {
        return $this->prixvehiculeevent;
    }

    public function setPrixVehiculeEvent(float $prixVehiculeEvent): self
    {
        $this->prixvehiculeevent = $prixVehiculeEvent;

        return $this;
    }




}
