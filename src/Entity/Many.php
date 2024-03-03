<?php

namespace App\Entity;

use App\Repository\ManyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManyRepository::class)]
class Many
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Dummy::class, inversedBy: 'manies')]
    #[ORM\JoinColumn(name: 'dummy_id', referencedColumnName: 'id', nullable: false)]
    private ?Dummy $dummy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDummy(): ?Dummy
    {
        return $this->dummy;
    }

    public function setDummy(?Dummy $dummy): static
    {
        $this->dummy = $dummy;

        return $this;
    }
}
