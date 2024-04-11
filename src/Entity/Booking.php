<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'bookings')]
#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'bkng_id', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(name: 'bkng_made_by', referencedColumnName: 'usr_id', nullable: false)]
    private ?User $made_by = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $opened_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $closed_at = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(name: 'bkng_status_id', referencedColumnName: 'bkst_id', nullable: false)]
    private ?BookingStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMadeBy(): ?User
    {
        return $this->made_by;
    }

    public function setMadeBy(?User $made_by): static
    {
        $this->made_by = $made_by;

        return $this;
    }

    public function getOpenedAt(): ?\DateTimeImmutable
    {
        return $this->opened_at;
    }

    public function setOpenedAt(\DateTimeImmutable $opened_at): static
    {
        $this->opened_at = $opened_at;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closed_at;
    }

    public function setClosedAt(\DateTimeInterface $closed_at): static
    {
        $this->closed_at = $closed_at;

        return $this;
    }

    public function getStatus(): ?BookingStatuses
    {
        return $this->status;
    }

    public function setStatus(BookingStatuses $status): static
    {
        $this->status = $status;

        return $this;
    }
}
