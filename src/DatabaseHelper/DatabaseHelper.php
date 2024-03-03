<?php

namespace App\DatabaseHelper;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManagerInterface;
use App\DBAL\EnumNationType;

class DatabaseHelper
{

    public function register(EntityManagerInterface $entityManager) 
    {
        // Register the custom Doctrine types
        //Type::addType('enumnation', EnumNationType::class);
        //$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enumnation', 'enumnation');
    }

    /**
     * Current database platform
     */
    public function getdbplat() 
    {
        $url = $_ENV['DATABASE_URL'];
        if (preg_match('/^(.*):\/\//', $url, $matches)) {
            $beforeColonSlashSlash = $matches[1];
            //return $beforeColonSlashSlash;
            return 'oracle';
        } else {
            return "No database configuration found.";
        }
    }   
}