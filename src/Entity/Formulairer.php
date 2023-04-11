<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormulairerRepository;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: FormulairerRepository::class)]


class Formulairer
{


#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
    private ?int $id;

#[ORM\Column(length : 255)]
    private ?string $nom;

    
#[ORM\Column]
    private ?int $tlp;

#[ORM\Column(length : 255)]
    private ?string  $mail;

#[ORM\Column]
    private ?int $nbr;

#[ORM\Column(length : 255)]
    private ?string $type;

#[ORM\Column(length : 255)]
    private ?string $categ;

#[ORM\Column(length : 255)]
    private ?string $depart;

#[ORM\Column(length : 255)]
    private ?string $destination;

#[ORM\Column(length : 255)]
    private ?string $opt;

public function getId(): ?int
{
    return $this->id;
}

public function getNom(): ?string
{
    return $this->nom;
}

public function setNom(string $nom): self
{
    $this->nom = $nom;

    return $this;
}

public function getTlp(): ?int
{
    return $this->tlp;
}

public function setTlp(int $tlp): self
{
    $this->tlp = $tlp;

    return $this;
}

public function getMail(): ?string
{
    return $this->mail;
}

public function setMail(string $mail): self
{
    $this->mail = $mail;

    return $this;
}

public function getNbr(): ?int
{
    return $this->nbr;
}

public function setNbr(int $nbr): self
{
    $this->nbr = $nbr;

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

public function getCateg(): ?string
{
    return $this->categ;
}

public function setCateg(string $categ): self
{
    $this->categ = $categ;

    return $this;
}

public function getDepart(): ?string
{
    return $this->depart;
}

public function setDepart(string $depart): self
{
    $this->depart = $depart;

    return $this;
}

public function getDestination(): ?string
{
    return $this->destination;
}

public function setDestination(string $destination): self
{
    $this->destination = $destination;

    return $this;
}

public function getOpt(): ?string
{
    return $this->opt;
}

public function setOpt(string $opt): self
{
    $this->opt = $opt;

    return $this;
}


}


