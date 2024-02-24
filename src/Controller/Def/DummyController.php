<?php

namespace App\Controller\Def;

use App\Entity\Dummy as Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DummyController extends AbstractController
{
    #[Route('/dummy', name: 'dummy_create')]
    public function create(EntityManagerInterface $entityManager, ValidatorInterface $validator, Request $request): Response
    {
        $entity = new Entity();
        $entity->setName($request->get('name'));
        $entity->setPrice(42);
        $entity->setDescription('DummyD');

        $errors = $validator->validate($entity);
        if (count($errors) > 0) {
            return new Response((string)$errors, 400);
        }

        $entityManager->persist($entity);
        $entityManager->flush();

        return $this->render('dummy/index.html.twig', [
            'entity' => $entity,
        ]);
    }

    #[Route('/dummy/{id}', name: 'dummy_show', methods: ['GET', 'HEAD'])]
    public function show(Entity $entity): Response
    {
        return $this->render('dummy/index.html.twig', [
            'entity' => $entity,
        ]);
    }

    #[Route('/dummy/edit/{id}', name: 'dummy_edit')]
    public function update(EntityManagerInterface $entityManager, int $id): Response
    {
        $entity = $entityManager->getRepository(Entity::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(
                'No entity found for id '.$id
            );
        }

        $entity->setName('New DummyN');
        $entityManager->flush();

        return $this->redirectToRoute('dummy_show', [
            'id' => $entity->getID(),
        ]);
    }

}
