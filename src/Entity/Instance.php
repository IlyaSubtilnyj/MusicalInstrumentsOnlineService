<?php

namespace App\Entity;

use App\Repository\InstanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'instances')]
#[ORM\Entity(repositoryClass: InstanceRepository::class)]
#[ORM\Index(name: 'IDX_inst_model_id', columns: ['inst_model_id'])]
#[ORM\Index(name: 'IDX_inst_manufacturer_id', columns: ['inst_manufacturer_id'])]
class Instance
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'inst_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'inst_description', type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'inst_serial_number', type: 'string', length: 50, nullable: true)]
    private ?string $serial_number = null;

    #[ORM\Column(name: 'inst_price', type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\ManyToOne(inversedBy: 'instances')]
    #[ORM\JoinColumn(name: 'inst_model_id', referencedColumnName: 'mdl_id')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'instances')]
    #[ORM\JoinColumn(name: 'inst_manufacturer_id', referencedColumnName: 'mnf_id')]
    private ?Manufacturer $manufacturer = null;

    #[ORM\ManyToOne(inversedBy: 'instances')]
    #[ORM\JoinColumn(name: 'inst_created_by', referencedColumnName: 'usr_id', nullable: false)]
    private ?User $created_by = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'instances')]
    #[ORM\JoinTable(name: 'm2m_instance_tags')]
    #[ORM\JoinColumn(name: 'instance_id', referencedColumnName: 'inst_id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'tg_id')]
    private Collection $tags;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'instance')]
    private Collection $orders;

    public function __construct()
    {
        $this->instances = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(?string $serial_number): static
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addInstance(Tag $instance): static
    {
        if (!$this->instances->contains($instance)) {
            $this->instances->add($instance);
        }

        return $this;
    }

    public function removeInstance(Tag $instance): static
    {
        $this->instances->removeElement($instance);

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setInstance($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getInstance() === $this) {
                $order->setInstance(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }
}
