<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity
 */
class Offre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ido;

    /**
     * @var string
     *
     * @ORM\Column(name="DescO", type="string", length=100, nullable=false)
     */
    private $desco;

    /**
     * @var string
     *
     * @ORM\Column(name="DureeO", type="string", length=100, nullable=false)
     */
    private $dureeo;

    public function getIdo(): ?int
    {
        return $this->ido;
    }

    public function getDesco(): ?string
    {
        return $this->desco;
    }

    public function setDesco(string $desco): self
    {
        $this->desco = $desco;

        return $this;
    }

    public function getDureeo(): ?string
    {
        return $this->dureeo;
    }

    public function setDureeo(string $dureeo): self
    {
        $this->dureeo = $dureeo;

        return $this;
    }


}
