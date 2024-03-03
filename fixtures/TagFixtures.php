<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\Entity\Tag;

class TagFixtures extends GroupInjectionFixture
{

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        // $manager->persist($product);
        
        $manager->flush();
    }

}
