<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $heure_fin = null;

    #[ORM\OneToMany(mappedBy: 'emplacementreservation', targetEntity: Emplacement::class)]
    private Collection $emplacementreservation;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Client::class)]
    private Collection $client;

    public function __construct()
    {
        $this->emplacementreservation = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacementreservation(): Collection
    {
        return $this->emplacementreservation;
    }

    public function addEmplacementreservation(Emplacement $emplacementreservation): static
    {
        if (!$this->emplacementreservation->contains($emplacementreservation)) {
            $this->emplacementreservation->add($emplacementreservation);
            $emplacementreservation->setEmplacementreservation($this);
        }

        return $this;
    }

    public function removeEmplacementreservation(Emplacement $emplacementreservation): static
    {
        if ($this->emplacementreservation->removeElement($emplacementreservation)) {
            // set the owning side to null (unless already changed)
            if ($emplacementreservation->getEmplacementreservation() === $this) {
                $emplacementreservation->setEmplacementreservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setClient($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getClient() === $this) {
                $client->setClient(null);
            }
        }

        return $this;
    }
}
