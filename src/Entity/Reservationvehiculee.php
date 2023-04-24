<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\reservationvehiculeeRepository;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Colaborationevent;


#[ORM\Entity(repositoryClass: reservationvehiculeeRepository::class)]
/**
 * Reservationvehiculee
 *
 * @ORM\Table(name="reservationvehiculee", indexes={@ORM\Index(name="fk_idEvent", columns={"IdEvent"})})
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
     * @var string
     *
     * @ORM\Column(name="NomClient", type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="The client name should not be blank.")
     * @Assert\Length(min=2, max=255)
     * @Assert\Regex(pattern="/^[a-zA-Z ]+$/", message="The client name should only contain letters and spaces.")
     */
    private $nomclient;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="The number of personne should not be blank.")
     * @ORM\Column(name="NbrClient", type="integer", nullable=false)
     */
    private $nbrclient;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: "veuillez remplir ce champ")]
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
