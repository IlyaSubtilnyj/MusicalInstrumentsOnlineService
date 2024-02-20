<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomDummyController extends AbstractController
{

    #[Route('/dummy/number')]
    public function get() : Response
    {
        $number = random_int(0, 100);
        return $this->render('dummy/number.html.twig', [
            'number' => $number,
        ]);
    }

}