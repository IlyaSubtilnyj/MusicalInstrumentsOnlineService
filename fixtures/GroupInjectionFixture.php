<?php

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

/**
 * Late static binding(get_called_class) variant
 * Runtime binding
 */
abstract class GroupInjectionFixture extends Fixture implements FixtureGroupInterface
{
    private static ?array $groups = null;

    /**
     * Not use it, better rewrite getGroups method. Reason: you can forget to restore to null value and other fixtures
     * within script execution will use your custom group
     */
    public static function setGroups(?array $groups = null) {
        self::$groups = $groups;
    }

    public static function getGroups(): array
    {
        if (is_null(self::$groups)) 
        {
            $mapping = require_once __DIR__ . '/unrelated/groups.php';
            self::$groups = $mapping[get_called_class()];
        }
            
        return self::$groups;
    }
    
}
