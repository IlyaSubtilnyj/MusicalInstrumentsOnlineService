<?php

namespace DataFixtures;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Early binding(__CLASS__)
 * Compile-time binding
 */
trait EntityNameFromFixtureTrait {

    private function getEntityNameFromFixtureName(): string
    {
        $entity_fixture_name = get_called_class();
        $match_expression = '/^'.__NAMESPACE__.'\\\\(.*)Fixtures/';
        if (preg_match($match_expression, $entity_fixture_name, $matches)) 
        {
            return $matches[1];
        }
        else {
            throw new Exception('Bad fixture name.');
        }
    }

}