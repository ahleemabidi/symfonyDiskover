<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="user",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="user_cin_unique", columns={"cin"})}
 * )
 * @UniqueEntity(fields={"cin"}, message="Ce numéro CIN est déjà utilisé.")
 *  * @UniqueEntity(fields={"email"}, message="Cet email est déjà utilisé.")

 */

class User  
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
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=255, nullable=false,unique=true)
     * @Assert\NotBlank(message="Le numéro CIN est obligatoire.")
     * @Assert\Regex(
     *     pattern="/^\d{8}$/",
     *     message="Le numéro CIN doit contenir exactement 8 chiffres."
     * )
     */
    private $cin;

     /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le nom est obligatoire.")
     */
    private $nom;

     /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le prenom est obligatoire.")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     *  @Assert\Choice(choices={"client", "admin", "chauffeur"})
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="L'email est obligatoire.")
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide.",
     *     mode = "strict"
     * )
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le mot de passe est obligatoire.")
     * @Assert\Length(min=8, minMessage="Le mot de passe doit contenir au moins {{ limit }} caractères.")
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
     *     message="Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial."
     * )
     */
    private $pwd;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }


}
