<?php

namespace App\Controller\Api;

use App\Validation\Requirement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomBlogApiController extends AbstractController
{

    #[Route('/api/posts/{id}', name: 'post_show', methods: ['GET', 'HEAD'], condition: "service('route_checker').check(request)")]
    public function show(int $id): Response {
        return new Response('show json: '.$id.' post');
    }

    #[Route('api/posts/{id}', methods: ['PUT'])]
    public function edit(int $id): Response {
        return new Response('edit json: '.$id.' post');
    }

    #[Route('api/posts-about-{category}/page/{pageNumber}', name: 'post_show_about', methods: ['GET', 'HEAD'], requirements: ['pageNumber' => Requirement::DIGITS])]
    public function show_spec(string $category, int $pageNumber): Response {
        return new Response('In '.__METHOD__.' '.$category.' '.$pageNumber);
    }

}