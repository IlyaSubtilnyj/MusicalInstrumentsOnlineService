<?php

namespace App\Controller\Def;

use App\Entity\User;
use App\Form\SignUpCustomerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SignUpCustomerController extends AbstractController
{
    #[Route('/signup', name: 'app_customer_registration')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
    
        $form = $this->createForm(SignUpCustomerFormType::class);
        $form->handleRequest($request);
        //dd($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {

            $regyUser = new User();

            $regyUser->setRoles(['ROLE_CUSTOMER']);
            $regyUser->setEmail($form->get('email')->getData());
            $regyUser->setPassword(
                $userPasswordHasher->hashPassword(
                    $regyUser,
                    $form->get('password')->getData()
                )
            );
            $regyUser->setMessage($form->get('message')->getData());

            $entityManager->persist($regyUser);
            $entityManager->flush();

            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/customer.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
