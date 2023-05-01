<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationvehiculeeRepository;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Colaborationevent;


#[ORM\Entity(repositoryClass: ReservationvehiculeeRepository::class)]
/**
 * Reservationvehiculee
 *
 * @ORM\Table(name="reservationvehiculee", indexes={@ORM\Index(name="fk_idEvent", columns={"IdEvent"})})
 * @ORM\Entity
 */
class Reservationvehiculee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $idreservationv;

    #[ORM\Column(name: 'NomClient', type: 'string', length: 255, nullable: false)]

    private $nomclient;

    #[ORM\Column(name: 'NbrClient', type: 'integer', length: 255, nullable: false)]

    private $nbrclient;

    #[ORM\Column(name: 'NomEvent', type: 'string', length: 255, nullable: false)]

    private $nomevent;

    /**
     * @var \Colaborationevent
     *
     * @ORM\ManyToOne(targetEntity="Colaborationevent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdEvent", referencedColumnName="IdEvent")
     * })
     */

    



    private $idevent;

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

    public function getIdevent(): ?Colaborationevent
{
    return $this->idevent ?? null ;
}


    public function setIdevent(?Colaborationevent $idevent): self
    {
        $this->idevent = $idevent;

        return $this;
    }


    
    

}
