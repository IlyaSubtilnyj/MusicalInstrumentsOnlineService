<?php

namespace App\Controller\Def;

use App\Controller\BaseController;
use App\Entity\Instrument;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validation\Requirement as ParamRules;
//use Symfony\Contracts\Translation\TranslatorInterface;


#[Route('/instruments', name: 'instruments.', options: ['expose' => true])]
class InstrumentsController extends BaseController
{

    #[Route('/', name: 'main')]
    public function main() : Response
    {
        //Log instruments page browsing
        $this->logger->info('Main page has been entered.');

        $entityManager = $this->getUserEntityManager();
        $categories = $entityManager->getRepository(Category::class)->findAll();
        return $this->render('instruments/main.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Instrument $entity) : Response {
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