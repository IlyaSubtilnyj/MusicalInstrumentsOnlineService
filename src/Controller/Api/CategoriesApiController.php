<?php

namespace App\Controller\Api;

use App\Entity\Category as Entity;
use App\Validation\Requirement as ParamRules;
use App\Trait\JsonEndpointTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categories', name: 'category_', options: ['expose' => true])]
class CategoriesApiController extends AbstractController
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
        $qb->select('c')
            ->from(Entity::class, 'c');
        $entities = $qb->getQuery()->getArrayResult();
        return new Response($entities, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'show', methods: 'GET', requirements: ['id' => ParamRules::POSITIVE_INT])]
    public function show(int $id): Response {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('c')
            ->from(Entity::class, 'c')
            ->where($qb->expr()->eq('c.id', ':cId'))
            ->setParameter('cId', $id);
        $entity = $qb->getQuery()->getArrayResult();
        
        $response = null;
        if(empty($entity)) 
        {
            $message = $this->cje(
                status: false,
                message: Entity::class.' not found'
            );
            $response = new Response($message, Response::HTTP_NOT_FOUND);
        }
        else
        {
            $response = new Response($entity[0], Response::HTTP_OK);
        }
        return $response;
    }

    #[Route('/', name: 'store', methods: 'POST', condition: 'service(\'category_checker\').check(request)')]
    public function store(Request $request): Response {
        $entity = new Entity();
        $entity->setName($request->get('name'));
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        
        $response = $this->cje(
            status: true, 
            message_name: 'category_id', 
            message: $entity->getID(),
        );
        return new Response($response, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'], condition: 'service(\'category_checker\').check(request)', 
            requirements: ['id' => ParamRules::POSITIVE_INT])]
    public function update(Request $request, int $id): Response {
        $data = json_decode($request->getContent(), true);
        $entity = $this->entityManager->getRepository(Entity::class)->find($id);

        $response = null;
        if(!$entity) 
        {
            $response = $this->cje(
                status: false,
                message: Entity::class.' not found'
            );
            $response = new Response($message, Response::HTTP_NOT_FOUND);
        }
        else
        {
            $entity->setName($data['name']);
            $this->entityManager->flush();

            $response = $this->cje(
                status: true,
                message: Entity::class.' is updated'
            );
            $response = new Response($response, Response::HTTP_OK);
        }
        return $response;
    }

    #[Route('/{id}', name: 'destroy', methods: ['DELETE'], requirements: ['id' => ParamRules::POSITIVE_INT])]
    public function destroy(int $id): Response {
        
        $entity = $this->entityManager->getRepository(Entity::class)->find($id);

        $response = null;
        if(!$entity) 
        {
            $response = $this->cje(
                status: false,
                message: Entity::class.' not found'
            );
            $response = new Response($response, Response::HTTP_NOT_FOUND);
        }
        else
        {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            $response = $this->cje(
                status: true,
                message: Entity::class.' is deleted'
            );
            $response = new Response($response, Response::HTTP_OK);
        }
        return $response;
    }



}