<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="reclamationId", columns={"reclamationId"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="resultat", type="string", length=255, nullable=true)
     */
    private $resultat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="num", type="integer", nullable=true)
     */
    private $num;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateR", type="date", nullable=true)
     */
    private $dater;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reclamationId", referencedColumnName="id")
     * })
     */
    private $reclamationid;

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(?string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getDater(): ?\DateTimeInterface
    {
        return $this->dater;
    }

    public function setDater(?\DateTimeInterface $dater): self
    {
        $this->dater = $dater;

        return $this;
    }

    public function getReclamationid(): ?Reclamation
    {
        return $this->reclamationid;
    }

    public function setReclamationid(?Reclamation $reclamationid): self
    {
        $this->reclamationid = $reclamationid;

        return $this;
    }


}
