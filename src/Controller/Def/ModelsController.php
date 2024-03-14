<?php

namespace App\Controller\Def;

use App\Controller\BaseController;
use App\Entity\Model;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validation\Requirement as ParamRules;
//use Symfony\Contracts\Translation\TranslatorInterface;
use App\DTO\CategoryDTO;

#[Route('/models', name: 'models.', options: ['expose' => true])]
class ModelsController extends BaseController
{

    #[Route('/', name: 'main')]
    public function main() : Response
    {
        //Log models page browsing
        $this->logger->info('Main page has been entered.');

        $entityManager = $this->getUserEntityManager();
        $categories = $entityManager->getRepository(Category::class)->findAll();

        $fetchCategories = [];
        foreach($categories as $category) {
            $fc = new CategoryDTO($category);
            array_push($fetchCategories, $fc->serialize());
        }

        return $this->render('models/main.html.twig', [
            'categories' => $fetchCategories,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Model $model) : Response {
        return $this->render('models/index.html.twig', [
            'model' => $model,
        ]);
    }

    #[Route('/category/{cid}', name: 'show_with_category')]
    public function show_with_category(int $cid) : Response {
        // $category = $this->entityManager->getRepository(Category::class)->find($cid);
        // $instruments = $category->getInstruments();
        return $this->render('models/index.html.twig', [
            //'manies' => $instruments,
        ]);
    }

}