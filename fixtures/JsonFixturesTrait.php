<?php

namespace DataFixtures;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Set json fixtures directory in .env with key FIXTURES_DATA_DIR
 */
trait JsonFixturesTrait {

    use EntityNameFromFixtureTrait;

    private function fromJson(?string $name = null): array
    {
        $name = $name ?? $this->getJsonDataSource();
        $jsonData = file_get_contents($name);
        if ($jsonData === false) {
            throw new Exception('Json fixture file doesn\'t exist.');
        }
        return json_decode($jsonData, true);
    }

    private function getJsonDataSource() {
        return dirname(__DIR__).$_ENV['FIXTURES_DATA_DIR'].lcfirst($this->getEntityNameFromFixtureName()).'.json';
    }

}