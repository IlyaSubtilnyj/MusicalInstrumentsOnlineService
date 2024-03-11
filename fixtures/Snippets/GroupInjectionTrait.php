<?php

namespace DataFixtures\Snippets;

/**
 * Early binding(__CLASS__)
 * Compile-time binding
 */
trait GroupInjectionTrait {

    public static function getGroups(): array
    {
        $mapping = require_once dirname(__DIR__) . '/Payload/groups.php';
        return $mapping[__CLASS__];
    }

}