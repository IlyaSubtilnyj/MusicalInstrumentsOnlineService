<?php

namespace App\Entity;

use App\Repository\ModelRepository;
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

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(name: 'mdl_category_id', referencedColumnName: 'ctg_id', nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(name: 'mdl_brand_id', referencedColumnName: 'brnd_id')]
    private ?Brand $brand = null;

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

}
