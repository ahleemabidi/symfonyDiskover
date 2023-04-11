<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Colaborationevent
 *
 * @ORM\Table(name="colaborationevent")
 * @ORM\Entity
 */
class Colaborationevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=255, nullable=false)
     */
    private $nomevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEvent", type="date", nullable=false)
     */
    private $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseEvent", type="string", length=255, nullable=false)
     */
    private $adresseevent;

    /**
     * @var int
     *
     * @ORM\Column(name="NbrPlaceVehicule", type="integer", nullable=false)
     */
    private $nbrplacevehicule;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixVehiculeEvent", type="integer", nullable=false)
     */
    private $prixvehiculeevent;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getNomevent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomevent(string $nomevent): self
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(\DateTimeInterface $dateevent): self
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    public function getAdresseevent(): ?string
    {
        return $this->adresseevent;
    }

    public function setAdresseevent(string $adresseevent): self
    {
        $this->adresseevent = $adresseevent;

        return $this;
    }

    public function getNbrplacevehicule(): ?int
    {
        return $this->nbrplacevehicule;
    }

    public function setNbrplacevehicule(int $nbrplacevehicule): self
    {
        $this->nbrplacevehicule = $nbrplacevehicule;

        return $this;
    }

    public function getPrixvehiculeevent(): ?int
    {
        return $this->prixvehiculeevent;
    }

    public function setPrixvehiculeevent(int $prixvehiculeevent): self
    {
        $this->prixvehiculeevent = $prixvehiculeevent;

        return $this;
    }


}
