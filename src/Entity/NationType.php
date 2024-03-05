<?php

namespace App\Entity;

use App\Repository\NationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DomainPropertyFromArrayTrait;


#[ORM\Table(name: 'nations_types')]
#[ORM\Entity(repositoryClass: NationTypeRepository::class)]
class NationType
{

    use DomainPropertyFromArrayTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'nt_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'nt_name', type: 'string', length: 50)]
    private ?string $name = null;

    #[ORM\Column(name: 'nt_description', type: 'string', length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Nation::class, mappedBy: 'type')]
    private Collection $nations;

    public function __construct()
    {
        $this->nations = new ArrayCollection();
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
}
