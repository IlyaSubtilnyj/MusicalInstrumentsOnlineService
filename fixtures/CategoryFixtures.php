<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DataFixtures\Snippets\DomainFromArrayFixture;
use DataFixtures\Snippets\JsonFixturesTrait;

class CategoryFixtures extends DomainFromArrayFixture
{

    use JsonFixturesTrait;

    public function __construct()
    {
        $this->a_entities = $this->fromJson();
    }

}
