<?php

namespace App\Entity;

use App\Repository\DummyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

//#[ORM\Entity(repositoryClass: DummyRepository::class)]
class Dummy
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Many::class, mappedBy: 'dummy')]
    private Collection $manies;

    public function __construct()
    {
        $this->manies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Many>
     */
    public function getManies(): Collection
    {
        return $this->manies;
    }

    public function addMany(Many $many): static
    {
        if (!$this->manies->contains($many)) {
            $this->manies->add($many);
            $many->setDummy($this);
        }

        return $this;
    }

    public function removeMany(Many $many): static
    {
        if ($this->manies->removeElement($many)) {
            // set the owning side to null (unless already changed)
            if ($many->getDummy() === $this) {
                $many->setDummy(null);
            }
        }

        return $this;
    }
}
