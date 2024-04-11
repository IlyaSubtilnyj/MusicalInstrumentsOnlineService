<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DomainPropertyFromArrayTrait;

#[ORM\Table(name: 'tags')]
#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\UniqueConstraint(name: 'UNQ_tg_label', columns: ["tg_label"])]
#[UniqueEntity(fields: ['label'], message: 'There is already a label with this name')]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'tg_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'tg_label', type: 'string', length: 50)]
    private ?string $label = null;

    #[ORM\Column(name: 'tg_description', type: 'string', length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'tags')]
    #[ORM\JoinColumn(name: 'tg_created_by', referencedColumnName: 'usr_id')]
    private ?User $created_by = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'default_tags')]
    private Collection $default_categories;

    #[ORM\ManyToMany(targetEntity: Instance::class, mappedBy: 'tags')]
    private Collection $instances;

    #[ORM\ManyToMany(targetEntity: Model::class, mappedBy: 'tags')]
    private Collection $models;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->default_categories = new ArrayCollection();
        $this->instances = new ArrayCollection();
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addTag($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getDefaultCategories(): Collection
    {
        return $this->default_categories;
    }

    public function addDefaultCategory(Category $defaultCategory): static
    {
        if (!$this->default_categories->contains($defaultCategory)) {
            $this->default_categories->add($defaultCategory);
            $defaultCategory->addDefaultTag($this);
        }

        return $this;
    }

    public function removeDefaultCategory(Category $defaultCategory): static
    {
        if ($this->default_categories->removeElement($defaultCategory)) {
            $defaultCategory->removeDefaultTag($this);
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
            $instance->addInstance($this);
        }

        return $this;
    }

    public function removeInstance(Instance $instance): static
    {
        if ($this->instances->removeElement($instance)) {
            $instance->removeInstance($this);
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
            $model->addTag($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            $model->removeTag($this);
        }

        return $this;
    }
}
