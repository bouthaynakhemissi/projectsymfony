<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $libelletype = null;



    #[ORM\ManyToOne(inversedBy: 'emplacementreservation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $emplacementreservation = null;

    public function getId(): ?int
    {
         return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getLibelletype(): ?string
    {
        return $this->libelletype;
    }

    public function setLibelletype(string $libelletype): static
    {
        $this->libelletype = $libelletype;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getEmplacementreservation(): ?Reservation
    {
        return $this->emplacementreservation;
    }

    public function setEmplacementreservation(?Reservation $emplacementreservation): static
    {
        $this->emplacementreservation = $emplacementreservation;

        return $this;
    }
}
