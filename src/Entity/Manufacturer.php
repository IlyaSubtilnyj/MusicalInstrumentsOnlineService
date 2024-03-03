<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'manufacturers')]
#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
//#[ORM\Index(NOINDEX, columns: ['mnf_nation_id'])]
//#[ORM\ForeignKey(name: 'FK_mnf_nation_id', columns: ['mnf_nation_id'])]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'mnf_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'mnf_name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'mnf_website', type: Types::TEXT, nullable: true)]
    private ?string $website = null;

    #[ORM\ManyToOne(inversedBy: 'manufacturers')]
    #[ORM\JoinColumn(name: 'mnf_nation_id', referencedColumnName: 'ntn_ccTLD',  nullable: false)]
    private ?Nation $nation = null;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getNation(): ?Nation
    {
        return $this->nation;
    }

    public function setNation(?Nation $nation): static
    {
        $this->nation = $nation;

        return $this;
    }
}
