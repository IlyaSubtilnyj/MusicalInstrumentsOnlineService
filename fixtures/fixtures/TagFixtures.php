<?php

namespace DataFixtures\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\Entity\Tag;
use Symfony\Component\Config\Definition\Exception\Exception;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TagFixtures extends DomainFromArrayFixture implements DependentFixtureInterface
{

    use JsonFixturesTrait;

    public function __construct()
    {
        $this->a_entities = $this->fromJson();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
