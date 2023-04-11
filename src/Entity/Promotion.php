<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion", indexes={@ORM\Index(name="fk_idO", columns={"idO"})})
 * @ORM\Entity
 */
class Promotion
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdPro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomP", type="string", length=100, nullable=true)
     */
    private $nomp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DureeP", type="integer", nullable=true)
     */
    private $dureep;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixAvant", type="integer", nullable=true)
     */
    private $prixavant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Pourcentage", type="integer", nullable=true)
     */
    private $pourcentage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixApres", type="integer", nullable=true)
     */
    private $prixapres;

    /**
     * @var \Offre
     *
     * @ORM\ManyToOne(targetEntity="Offre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idO", referencedColumnName="idO")
     * })
     */
    private $ido;

    public function getIdpro(): ?int
    {
        return $this->idpro;
    }

    public function getNomp(): ?string
    {
        return $this->nomp;
    }

    public function setNomp(?string $nomp): self
    {
        $this->nomp = $nomp;

        return $this;
    }

    public function getDureep(): ?int
    {
        return $this->dureep;
    }

    public function setDureep(?int $dureep): self
    {
        $this->dureep = $dureep;

        return $this;
    }

    public function getPrixavant(): ?int
    {
        return $this->prixavant;
    }

    public function setPrixavant(?int $prixavant): self
    {
        $this->prixavant = $prixavant;

        return $this;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(?int $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getPrixapres(): ?int
    {
        return $this->prixapres;
    }

    public function setPrixapres(?int $prixapres): self
    {
        $this->prixapres = $prixapres;

        return $this;
    }

    public function getIdo(): ?Offre
    {
        return $this->ido;
    }

    public function setIdo(?Offre $ido): self
    {
        $this->ido = $ido;

        return $this;
    }


}
