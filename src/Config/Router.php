<?php

namespace App\Config;

use FastRoute\RouteCollector;
use App\Controller\UserController;

class Router
{
    public static function config()
    {
        return \FastRoute\simpleDispatcher(function (RouteCollector $routes) {

            $routes->addGroup('/v1', function (RouteCollector $r) {
                $r->addRoute('GET', '/users',  [UserController::class, 'getCollection']);
                $r->addRoute('GET', '/users/{id:\d+}',  [UserController::class, 'getItem']);
            });

        });
    }
}