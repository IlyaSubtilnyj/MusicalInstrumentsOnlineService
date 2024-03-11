<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DataFixtures\Snippets\DomainFromArrayFixture;
use DataFixtures\Snippets\JsonFixturesTrait;

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
