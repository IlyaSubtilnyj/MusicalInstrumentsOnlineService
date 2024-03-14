<?php

namespace App\Controller\Api;

use App\Entity\Model;
use App\Entity\Category;
use App\Validation\Requirement as ParamRules;
use App\Trait\JsonEndpointTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse as Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\DTO\InstrumentDTO;

#[Route('/models', name: 'models.', options: ['expose' => true])]
class ModelsApiController extends AbstractController
{

    use JsonEndpointTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/{id}', name: 'show_with_categoty', methods: 'GET')]
    public function show_with_category(int $id) {
        $category = $this->entityManager->getRepository(Category::class)->find($id);
        $models = $category->getModels();
        $array = [];
        foreach($models as $instrument) {
            $inst = new InstrumentDTO($instrument);
            array_push($array, $inst->serialize());
        }
        return new Response($array, Response::HTTP_OK);
    }

    #[Route('/', name: 'index', methods: 'GET')]
    public function index(): Response {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('m', 'c')
            ->from(Model::class, 'm')
            ->leftJoin('m.category', 'c');
        $entities = $qb->getQuery()->getArrayResult();
        return new Response($entities, Response::HTTP_OK);
    }

    // #[Route('/{id}', name: 'show', methods: 'GET', requirements: ['id' => ParamRules::POSITIVE_INT])]
    // public function show(int $id): Response {
    //     $qb = $this->entityManager->createQueryBuilder();
    //     $qb->select('i', 'c')
    //         ->from(Entity::class, 'i')
    //         ->leftJoin('i.category', 'c')
    //         ->where('i.id = :iId')
    //         ->setParameter('iId', $id);
    //     $entity = $qb->getQuery()->getArrayResult();
        
    //     if(empty($entity)) 
    //     {
    //         $response = $this->cje(
    //             status: false,
    //             message: Entity::class.' not found');
    //         return new Response($response, Response::HTTP_NOT_FOUND, [], JSON_PRETTY_PRINT);
    //     }
    //     else
    //     {
    //         return new Response($entity[0], Response::HTTP_OK);
    //     }      
    // }

}