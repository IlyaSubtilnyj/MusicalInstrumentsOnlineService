<?php

namespace DataFixtures;

/**
 * Early binding(__CLASS__)
 * Compile-time binding
 */
trait GroupInjectionTrait {

    public static function getGroups(): array
    {
        $mapping = include 'groups.php';
        return $mapping[__CLASS__];
    }

}