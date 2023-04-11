<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationvehiculee
 *
 * @ORM\Table(name="reservationvehiculee")
 * @ORM\Entity
 */
class Reservationvehiculee
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdReservationv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NomClient", type="string", length=255, nullable=true)
     */
    private $nomclient;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbrClient", type="integer", nullable=true)
     */
    private $nbrclient;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=255, nullable=false)
     */
    private $nomevent;

    public function getIdreservationv(): ?int
    {
        return $this->idreservationv;
    }

    public function getNomclient(): ?string
    {
        return $this->nomclient;
    }

    public function setNomclient(?string $nomclient): self
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getNbrclient(): ?int
    {
        return $this->nbrclient;
    }

    public function setNbrclient(?int $nbrclient): self
    {
        $this->nbrclient = $nbrclient;

        return $this;
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


}
