<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DomainPropertyFromArrayTrait;

#[ORM\Table(name: 'categories')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\UniqueConstraint(name: 'UNQ_ctg_name',columns: ["ctg_name"])]
class Category
{

    use DomainPropertyFromArrayTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'ctg_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'ctg_name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'ctg_description', type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'category')]
    private Collection $models;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'categories')]
    #[ORM\JoinTable(name: 'm2m_category_tags')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'ctg_id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'tg_id')]
    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'default_categories')]
    #[ORM\JoinTable(name: 'm2m_default_category_tags')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'ctg_id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'tg_id')]
    private Collection $default_tags;

    #[ORM\OneToMany(targetEntity: MetaCategorySpecs::class, mappedBy: 'category')]
    private Collection $metaCategorySpecs;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->default_tags = new ArrayCollection();
        $this->metaCategorySpecs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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
            $model->setCategory($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getCategory() === $this) {
                $model->setCategory(null);
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
            $tag->addCategory($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getDefaultTags(): Collection
    {
        return $this->default_tags;
    }

    public function addDefaultTag(Tag $defaultTag): static
    {
        if (!$this->default_tags->contains($defaultTag)) {
            $this->default_tags->add($defaultTag);
            $defaultTag->addDefaultCategory($this);
        }

        return $this;
    }

    public function removeDefaultTag(Tag $defaultTag): static
    {
        if ($this->default_tags->removeElement($defaultTag)) {
            $defaultTag->removeDefaultCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MetaCategorySpecs>
     */
    public function getMetaCategorySpecs(): Collection
    {
        return $this->metaCategorySpecs;
    }

    public function addMetaCategorySpec(MetaCategorySpecs $metaCategorySpec): static
    {
        if (!$this->metaCategorySpecs->contains($metaCategorySpec)) {
            $this->metaCategorySpecs->add($metaCategorySpec);
            $metaCategorySpec->setCategory($this);
        }

        return $this;
    }

    public function removeMetaCategorySpec(MetaCategorySpecs $metaCategorySpec): static
    {
        if ($this->metaCategorySpecs->removeElement($metaCategorySpec)) {
            // set the owning side to null (unless already changed)
            if ($metaCategorySpec->getCategory() === $this) {
                $metaCategorySpec->setCategory(null);
            }
        }

        return $this;
    }
}
