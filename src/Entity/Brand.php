<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'brands')]
#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'brnd_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'brnd_name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'brand')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
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

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

        return $this;
    }
}
