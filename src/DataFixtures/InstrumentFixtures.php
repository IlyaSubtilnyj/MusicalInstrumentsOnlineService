<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InstrumentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create categories
        $category1 = new Category();
        $category1->setName('Guitars');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Drums');
        $manager->persist($category2);

        // Create instruments
        $instrument1 = new Instrument();
        $instrument1->setName('Fender Stratocaster');
        $instrument1->setCategory($category1);
        $manager->persist($instrument1);

        $instrument2 = new Instrument();
        $instrument2->setName('Gibson Les Paul');
        $instrument2->setCategory($category1);
        $manager->persist($instrument2);

        $instrument3 = new Instrument();
        $instrument3->setName('Pearl Export');
        $instrument3->setCategory($category2);
        $manager->persist($instrument3);

        // Flush changes to database
        $manager->flush();
    }
}
