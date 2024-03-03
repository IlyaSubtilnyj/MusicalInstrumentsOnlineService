<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category as Entity;

class CategoryFixtures extends Fixture
{
    private ?array $category_array = null;

    public function __construct() 
    {
        $this->category_array = array(
            array('name' => 'String', 'description' => 'Instruments that produce sound through vibrating strings.'),
            array('name' => 'Brass', 'description' => 'Instruments typically made of brass or other metal alloys.'),
            array('name' => 'Woodwind', 'description' => 'Instruments that produce sound by blowing air through a wooden or metal mouthpiece.'),
            array('name' => 'Percussion', 'description' => 'Instruments played by striking or shaking.'),
            array('name' => 'Keyboard', 'description' => 'Instruments with a row of keys producing musical tones.'),
            array('name' => 'Electronic', 'description' => 'Instruments that rely on electronic amplification to produce sound.'),
            array('name' => 'Wind', 'description' => 'Instruments played by blowing air directly into or across them.'),
            array('name' => 'Piano', 'description' => 'A keyboard instrument with a row of keys producing musical tones, often used for solo performances and accompaniment.'),
            array('name' => 'Guitar', 'description' => 'A stringed instrument with a fretted neck and typically six strings, commonly used in various musical genres.'),
            array('name' => 'Drums', 'description' => 'Percussion instruments played by striking or beating, consisting of various drums and cymbals.')
        );
        
    }

    public function load(ObjectManager $manager): void
    {

        foreach($this->category_array as $category)
        {
            $manager->persist((new Entity())->setPropertiesFromArray($category));    
        }
        
        $manager->flush();
        
    }


}
