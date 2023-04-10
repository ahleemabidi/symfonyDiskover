<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Reclamation;
/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idclient;

    /**
     * @ORM\Column(type="integer")
     */
    private $idchauffeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $resultat;
     /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reclamation", inversedBy="reponse")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reclamation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateR;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdclient(): ?int
    {
        return $this->idclient;
    }

    public function setIdclient(int $idclient): self
    {
        $this->idclient = $idclient;

        return $this;
    }

    public function getIdchauffeur(): ?int
    {
        return $this->idchauffeur;
    }

    public function setIdchauffeur(int $idchauffeur): self
    {
        $this->idchauffeur = $idchauffeur;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->dateR;
    }

    public function setDateR(\DateTimeInterface $dateR): self
    {
        $this->dateR = $dateR;

        return $this;
    }
    public function getReclamation(): ?Reclamation
    {
        return $this->reclamation;
    }

    public function setReclamation(Reclamation $reclamation): self
    {
        $this->reclamation = $reclamation;

        return $this;
    }
}
