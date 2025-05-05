<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->group('/', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('', 'LandingPage_Controller');
});

$routes ->get('/sign-up', 'AuthController::signUp');
$routes->post('/sign-up', 'AuthController::handleSignUp');

$routes->get('/sign-in', 'AuthController::signIn');
$routes->post('/sign-in', 'AuthController::handleSignIn');