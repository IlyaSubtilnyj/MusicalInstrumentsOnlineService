<?php

namespace App\Controller\Def;

use App\Entity\Dummy;
use App\Entity\Many;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dummy')]
class DummyController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_dummy')]
    public function index(EntityManagerInterface $manager): Response
    {
        $all = $manager->getRepository(Dummy::class)->findAll();
        return new Response(json_encode($all, true));
    }

    #[Route('/store')]
    public function store() {
        $dummy = new Dummy();
        $this->entityManager->persist($dummy);
        $this->entityManager->flush($dummy);
        return new Response($dummy->getId());
    }

    #[Route('/store/{id}')]
    public function storeMany(Dummy $dummy) {
        $many = new Many();
        $many->setDummy($dummy);
        $this->entityManager->persist($many);
        $this->entityManager->flush($many);
        return new Response(json_encode($many));
    }

    #[Route('/get/{id}')]
    public function getManies(int $id) {
        $dummy = $this->entityManager->getRepository(Dummy::class)->find($id);
        $collection = $dummy->getManies();
        return $this->render('instruments/index.html.twig', [
            'dummy' => $dummy,
            'manies' => $collection,
        ]);
    }

}
