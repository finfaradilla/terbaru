<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->setDefaultMethod('index');
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
});