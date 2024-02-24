<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Routing\Attribute\AsRoutingConditionService;

#[AsRoutingConditionService(alias: 'route_checker')]
class RouteChecker
{

    public function check(Request $request): bool {
        return true;//params['id'] < 1000;
    }

}