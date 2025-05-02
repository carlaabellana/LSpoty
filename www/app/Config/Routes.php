<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');


$routes->group('/', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('', 'LandingPage_Controller');
});