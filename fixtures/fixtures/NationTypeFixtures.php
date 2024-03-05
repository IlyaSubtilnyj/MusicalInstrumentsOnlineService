<?php

namespace DataFixtures\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationTypeFixtures extends DomainFromArrayFixture
{

    use JsonFixturesTrait;

    public function __construct()
    {
        $this->a_entities = $this->fromJson();
    }

}
