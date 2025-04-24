<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?self
    {
        return $this->nom;
    }

    public function setNom(?self $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
