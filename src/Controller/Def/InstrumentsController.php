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
use Psr\Log\LoggerInterface;
use App\DatabaseHelper\DatabaseHelper as DBHelper;

#[Route('/instruments', name: 'instruments.', options: ['expose' => true])]
class InstrumentsController extends AbstractController
{

    private $entityManager;
    private $logger;
    private $dbhelp;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger, DBHelper $dbhelp)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->dbhelp = $dbhelp;
    }

    #[Route('/', name: 'main')]
    public function main() : Response
    {
        //dd($this->dbhelp->getdbplat());
        $this->logger->info('This is an info message.');
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

    #[Route('/category/{cid}', name: 'show_with_category')]
    public function show_with_category(int $cid) : Response {
        $category = $this->entityManager->getRepository(Category::class)->find($cid);
        $instruments = $category->getInstruments();
        return $this->render('instruments/index.html.twig', [
            'manies' => $instruments,
        ]);
    }

}