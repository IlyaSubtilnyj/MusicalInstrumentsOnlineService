<?php

namespace App\Controller;

use App\Validation\Requirement as ParamRules;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

class dController extends AbstractController
{

    #[Route('/d', name: 'd')]
    public function d() : Response
    {
        $number = random_int(0, 100);
        return $this->render('dummy/number.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route('/dp/{param?}', condition: 'service(\'route_checker\').check(request)', requirements: ['param' => ParamRules::DIGITS])]
    public function dp(TranslatorInterface $translator, ?int $param) : Response {
        $translated = $translator->trans('Symfony');
        return new Response($translated);
    }

    #[Route('/dr', name: 'd_request')]
    public function dr(Request $request) : Response {
        //var_dump($request->attributes->get('_route'));
        //var_dump($request->attributes->get('_route_params'));

        $allAttributes = $request->attributes->all();

        return new Response(var_dump($allAttributes));
    }

}