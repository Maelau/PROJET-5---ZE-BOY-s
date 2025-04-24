<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    /**
     * @var Collection<int, Lignefacture>
     */
    #[ORM\OneToMany(targetEntity: Lignefacture::class, mappedBy: 'facture')]
    private Collection $lignefactures;

    public function __construct()
    {
        $this->lignefactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Lignefacture>
     */
    public function getLignefactures(): Collection
    {
        return $this->lignefactures;
    }

    public function addLignefacture(Lignefacture $lignefacture): static
    {
        if (!$this->lignefactures->contains($lignefacture)) {
            $this->lignefactures->add($lignefacture);
            $lignefacture->setFacture($this);
        }

        return $this;
    }

    public function removeLignefacture(Lignefacture $lignefacture): static
    {
        if ($this->lignefactures->removeElement($lignefacture)) {
            // set the owning side to null (unless already changed)
            if ($lignefacture->getFacture() === $this) {
                $lignefacture->setFacture(null);
            }
        }

        return $this;
    }
}
