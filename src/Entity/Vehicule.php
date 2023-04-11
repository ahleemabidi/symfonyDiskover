<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="disponibilite", type="integer", nullable=false)
     */
    private $disponibilite;

    /**
     * @var int
     *
     * @ORM\Column(name="num_entretien", type="integer", nullable=false)
     */
    private $numEntretien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_entretien", type="date", nullable=false)
     */
    private $dateEntretien;

    /**
     * @var string
     *
     * @ORM\Column(name="res_entretien", type="string", length=255, nullable=false)
     */
    private $resEntretien;

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

    public function getDateEntretien(): ?\DateTimeInterface
    {
        return $this->dateEntretien;
    }

    public function setDateEntretien(\DateTimeInterface $dateEntretien): self
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
