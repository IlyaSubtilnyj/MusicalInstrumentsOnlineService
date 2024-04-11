<?php

namespace App\Entity;

use App\Repository\BookingStatusesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'booking_statuses')]
#[ORM\Entity(repositoryClass: BookingStatusesRepository::class)]
#[ORM\UniqueConstraint(name: 'UNQ_bkst_name', columns: ["bkst_name"])]
class BookingStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'bkst_id', type: Types::SMALLINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'bkst_name', type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'status')]
    private Collection $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking): static
    {
        // set the owning side of the relation if necessary
        if ($booking->getStatus() !== $this) {
            $booking->setStatus($this);
        }

        $this->booking = $booking;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setStatus($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getStatus() === $this) {
                $booking->setStatus(null);
            }
        }

        return $this;
    }
}
