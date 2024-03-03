<?php

namespace App\Entity;

use App\Repository\NationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\DBAL\EnumNationType;

#[ORM\Table(name: 'nations')]
#[ORM\Entity(repositoryClass: NationRepository::class)]
class Nation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'ntn_ccTLD', type: 'string', length: 2)]
    private ?string $ccTLD = null;

    #[ORM\Column(name: 'ntn_name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'ntn_type', type: 'enumnation')]
    private ?EnumNationType $type = null;

    #[ORM\OneToMany(targetEntity: Manufacturer::class, mappedBy: 'nation')]
    private Collection $manufacturers;

    public function __construct()
    {
        $this->manufacturers = new ArrayCollection();
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

    public function getType(): ?EnumNationType
    {
        return $this->type;
    }

    public function setType(EnumNationType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Manufacturer>
     */
    public function getManufacturers(): Collection
    {
        return $this->manufacturers;
    }

    public function addManufacturer(Manufacturer $manufacturer): static
    {
        if (!$this->manufacturers->contains($manufacturer)) {
            $this->manufacturers->add($manufacturer);
            $manufacturer->setNation($this);
        }

        return $this;
    }

    public function removeManufacturer(Manufacturer $manufacturer): static
    {
        if ($this->manufacturers->removeElement($manufacturer)) {
            // set the owning side to null (unless already changed)
            if ($manufacturer->getNation() === $this) {
                $manufacturer->setNation(null);
            }
        }

        return $this;
    }
}
