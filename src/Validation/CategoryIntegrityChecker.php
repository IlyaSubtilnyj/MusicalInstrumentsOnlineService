<?php

namespace App\Validation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Routing\Attribute\AsRoutingConditionService;

#[AsRoutingConditionService(alias: 'category_checker')]
class CategoryIntegrityChecker
{
    public function check(Request $request): bool {
        return match ($request->getMethod()) {
            'POST' => !is_null($request->get('name')),
            'PUT', 'PATCH' => !is_null(json_decode($request->getContent(), true)['name']),
            default => true,
        };
    }
}