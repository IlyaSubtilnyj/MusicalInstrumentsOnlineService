<?php

declare(strict_types=1);

namespace App\Migrations\Factory;

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\AbstractMigration;
use Psr\Log\LoggerInterface;
use App\DatabaseHelper\DatabaseHelper;

class MigrationFactory implements \Doctrine\Migrations\Version\MigrationFactory
{
    /** @var Connection */
    private $connection;

    /** @var LoggerInterface */
    private $logger;

    /**
     * @var DatabaseHelper
     */
    private $service;

    public function __construct(Connection $connection, LoggerInterface $logger, DatabaseHelper $service)
    {
        $this->connection = $connection;
        $this->logger     = $logger;
        $this->service = $service;
    }

    public function createVersion(string $migrationClassName) : AbstractMigration
    {
        $migration = new $migrationClassName(
            $this->connection,
            $this->logger
        );

        // or you can ommit this check
        //if ($migration instanceof SomeInterface) {
        //    $migration->setService($this->service);
        //}

        return $migration;
    }
}
