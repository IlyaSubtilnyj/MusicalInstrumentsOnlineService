<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Doctrine\EntityManager\EntityManagerManager;
use Psr\Log\LoggerInterface;
use App\Doctrine\Connection\ConnectionManager;
use Doctrine\ORM\EntityManagerInterface;

use App\DatabaseHelper\DatabaseHelper as DBHelper;

class BaseController extends AbstractController
{

    public function __construct(
        //private ConnectionManager $connectionManager, 
        private EntityManagerManager $entityManagerManager,
        protected LoggerInterface $logger
    ) {}

    protected function getUserConnection(): Connection 
    {
        $userRole = $this->getUserRole();
        if (is_null($userRole)) {
            throw new \LogicException('User doesn\'t authenticated.');
        }
        /** closed */
        //return $this->connectionManager->getConnection($userRole);
        return $this->getUserEntityManager()->getConnection();
    }

    protected function getUserEntityManager(): EntityManagerInterface 
    {
        $userRole = $this->getUserRole();
        if (is_null($userRole)) {
            throw new \LogicException('User doesn\'t authenticated.');
        }
        return $this->entityManagerManager->getEntityManager($userRole);
    }

    protected function getUserRole(): ?string 
    {
        return 'ROLE_CUSTOMER';
        return $this->getUser()?->getRole();
    }

}
