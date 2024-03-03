<?php

namespace App\Entity;

use App\Repository\MetaCategorySpecsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'meta_category_specs')]
#[ORM\Entity(repositoryClass: MetaCategorySpecsRepository::class)]
#[ORM\Index(name: 'IDX_cs_category_id', columns: ['cs_category_id'])]
class MetaCategorySpecs
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'cs_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'cs_specs', type: 'string', length: 64, nullable: true)]
    private ?string $specs = null;

    #[ORM\ManyToOne(inversedBy: 'metaCategorySpecs')]
    #[ORM\JoinColumn(name: 'cs_category_id', referencedColumnName: 'ctg_id', nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(?string $specs): static
    {
        $this->specs = $specs;

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
}
