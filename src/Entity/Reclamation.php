<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $objet;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $date;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reponse")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $reponse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
    public function getReponse(): ?Reponse
    {
        return $this->reponse;
    }

    public function setReponse(Reponse $reponse): self
    {
        $this->reponse = $reponse;

        // set the owning side of the relation if necessary
        if ($reponse->getReclamation() !== $this) {
            $reponse->setReclamation($this);
        }

        return $this;
    }
}

