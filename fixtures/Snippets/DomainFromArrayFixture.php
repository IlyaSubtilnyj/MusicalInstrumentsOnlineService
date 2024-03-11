<?php

namespace DataFixtures\Snippets;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Late static binding(get_called_class) variant
 * Runtime binding
 */
abstract class DomainFromArrayFixture extends GroupInjectionFixture
{
    use EntityNameFromFixtureTrait;
    
    protected ?array $a_entities = null;

    public function load(ObjectManager $manager): void
    {

        $EntityClass = $this->getEntityClassNameWithNamespace();

        if ($this->a_entities !== null) {
            foreach($this->a_entities as $entity)
            {
                $manager->persist((new $EntityClass())->setPropertiesFromArray($entity));    
            }
        }

        $manager->flush();

    }

    private function getEntityClassNameWithNamespace(): string
    {
        return 'App\\Entity\\'.$this->getEntityNameFromFixtureName();
    }

}
