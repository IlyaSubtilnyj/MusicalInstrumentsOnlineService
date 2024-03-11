<?php

namespace App\Doctrine\Connection;

use Doctrine\DBAL\ConnectionRegistry;
use Doctrine\DBAL\Connection;

class ConnectionManager
{
    private $connectionRegistry;

    public function __construct(ConnectionRegistry $connectionRegistry)
    {
        $this->connectionRegistry = $connectionRegistry;
    }

    public function getConnection(string $userRole): Connection
    {
        // Switch between connections based on user role
        return match ($userRole) {
            'ROLE_USER'     => $this->connectionRegistry->getConnection('customer'),
            'ROLE_ADMIN'    => $this->connectionRegistry->getConnection('default'),
            default         => $this->connectionRegistry->getConnection('default'),
        };
    }
}
