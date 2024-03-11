<?php

namespace App\Doctrine\EntityManager;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class EntityManagerManager
{
    private $entityManagerRegistry;

    public function __construct(ManagerRegistry $entityManagerRegistry)
    {
        $this->entityManagerRegistry = $entityManagerRegistry;
    }

    public function getEntityManager(string $userRole): EntityManagerInterface
    {
        // Switch between entity managers based on user role
        return match ($userRole) {
            'ROLE_USER'     => $this->entityManagerRegistry->getManager('customer'),
            'ROLE_ADMIN'    => $this->entityManagerRegistry->getManager('default'),
            default         => $this->entityManagerRegistry->getManager('default'),
        };
    }
}