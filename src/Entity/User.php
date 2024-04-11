<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'users')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNQ_usr_email', columns: ["usr_email"])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'usr_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'usr_email', type: 'string', length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(name: 'usr_roles', type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(name: 'usr_password', type: 'string', length: 255)]
    private ?string $password = null;

    #[ORM\Column(name: 'usr_message', type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToMany(targetEntity: Notice::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'm2m_user_notices')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'usr_id')]
    #[ORM\InverseJoinColumn(name: 'notice_id', referencedColumnName: 'ntc_id')]
    private Collection $notices;

    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'made_by')]
    private Collection $bookings;

    #[ORM\OneToMany(targetEntity: Tag::class, mappedBy: 'created_by')]
    private Collection $tags;

    #[ORM\OneToMany(targetEntity: Instance::class, mappedBy: 'created_by')]
    private Collection $instances;

    public function __construct()
    {
        $this->notices = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->instances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_CUSTOMER
        $roles[] = 'ROLE_OPPRESSED';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->password = null;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, Notices>
     */
    public function getNotices(): Collection
    {
        return $this->notices;
    }

    public function addNotice(Notices $notice): static
    {
        if (!$this->notices->contains($notice)) {
            $this->notices->add($notice);
        }

        return $this;
    }

    public function removeNotice(Notices $notice): static
    {
        $this->notices->removeElement($notice);

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
            $booking->setMadeBy($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getMadeBy() === $this) {
                $booking->setMadeBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getCreatedBy() === $this) {
                $tag->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Instance>
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addInstance(Instance $instance): static
    {
        if (!$this->instances->contains($instance)) {
            $this->instances->add($instance);
            $instance->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInstance(Instance $instance): static
    {
        if ($this->instances->removeElement($instance)) {
            // set the owning side to null (unless already changed)
            if ($instance->getCreatedBy() === $this) {
                $instance->setCreatedBy(null);
            }
        }

        return $this;
    }

}
