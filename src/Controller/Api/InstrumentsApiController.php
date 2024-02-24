<?php

namespace App\Controller\Api;

use App\Entity\Instrument as Entity;
use App\Validation\Requirement as ParamRules;
use App\Trait\JsonEndpointTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/instruments', name: 'instrument_')]
class InstrumentsApiController extends AbstractController
{

    use JsonEndpointTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'show_all', methods: 'GET')]
    public function show_all(): Response {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('i', 'c')
            ->from(Entity::class, 'i')
            ->leftJoin('i.category', 'c');
        $entities = $qb->getQuery()->getArrayResult();
        return new Response($entities, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'show', methods: 'GET', requirements: ['id' => ParamRules::POSITIVE_INT])]
    public function show(int $id): Response {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('i', 'c')
            ->from(Entity::class, 'i')
            ->leftJoin('i.category', 'c')
            ->where('i.id = :iId')
            ->setParameter('iId', $id);
        $entity = $qb->getQuery()->getArrayResult();
        
        if(empty($entity)) 
        {
            $response = $this->cje(
                status: false,
                message: Entity::class.' not found');
            return new Response($response, Response::HTTP_NOT_FOUND, [], JSON_PRETTY_PRINT);
        }
        else
        {
            return new Response($entity[0], Response::HTTP_OK);
        }      
    }

}