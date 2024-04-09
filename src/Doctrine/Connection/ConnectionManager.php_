<?php

namespace App\Doctrine\Connection;

use Doctrine\DBAL\ConnectionRegistry;
use Doctrine\DBAL\Connection;

class ConnectionManager
{
    private $connectionRegistry;

    public function __construct(ConnectionRegistry $connectionRegistry)
    {
        throw new \DeprecatedException('This class is deprecated.');
        $this->connectionRegistry = $connectionRegistry;
    }

    public function getConnection(string $userRole): Connection
    {
        throw new \DeprecatedException('This class is deprecated.');
        // Switch between connections based on user role
        return match ($userRole) {
            'ROLE_USER'     => $this->connectionRegistry->getConnection('customer'),
            'ROLE_ADMIN'    => $this->connectionRegistry->getConnection('default'),
            default         => $this->connectionRegistry->getConnection('default'),
        };
    }
}
