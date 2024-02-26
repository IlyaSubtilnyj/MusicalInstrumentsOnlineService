<?php

namespace App\Controller\Def;

use App\Entity\Instrument as Entity;
use App\Entity\Category;
use App\Validation\Requirement as ParamRules;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/instruments', name: 'instruments.')]
class InstrumentsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'main')]
    public function main() : Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        return $this->render('instruments/main.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Entity $entity) : Response {
        dd($entity);
        return $this->render('instruments', [
            'instrument' => $entity,
        ]);
    }

}