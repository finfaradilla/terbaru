<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->setAutoRoute(true);
$routes->setDefaultMethod('index');
// $routes->group('Home', ['filter' => 'auth'], function($routes) {
//     $routes->get('/', 'Home::dashboard');
// });