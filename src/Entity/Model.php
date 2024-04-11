<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'models')]
#[ORM\Entity(repositoryClass: ModelRepository::class)]
#[ORM\Index(name: 'IDX_mdl_category_id', columns: ['mdl_category_id'])]
#[ORM\Index(name: 'IDX_mdl_brand_id', columns: ['mdl_brand_id'])]
//#[ORM\ForeignKey(name: 'FK_mdl_category_id', columns: ['mdl_category_id'])]
//#[ORM\ForeignKey(name: 'FK_mdl_brand_id', columns: ['mdl_brand_id'])]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'mdl_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'mdl_name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'mdl_description', type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'mdl_is_in_stock', type: Types::BOOLEAN, options: ["default" => 0])]
    private ?bool $is_in_stock = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(name: 'mdl_category_id', referencedColumnName: 'ctg_id', nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(name: 'mdl_brand_id', referencedColumnName: 'brnd_id')]
    private ?Brand $brand = null;

    #[ORM\OneToMany(targetEntity: Instance::class, mappedBy: 'model')]
    private Collection $instances;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'models')]
    #[ORM\JoinTable(name: 'm2m_model_tags')]
    #[ORM\JoinColumn(name: 'model_id', referencedColumnName: 'mdl_id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'tg_id')]
    private Collection $tags;

    public function __construct()
    {
        $this->instances = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

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
            $instance->setModel($this);
        }

        return $this;
    }

    public function removeInstance(Instance $instance): static
    {
        if ($this->instances->removeElement($instance)) {
            // set the owning side to null (unless already changed)
            if ($instance->getModel() === $this) {
                $instance->setModel(null);
            }
        }

        return $this;
    }

    public function isIsInStock(): ?bool
    {
        return $this->is_in_stock;
    }

    public function setIsInStock(bool $is_in_stock): static
    {
        $this->is_in_stock = $is_in_stock;

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
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

}
