<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->group('/', ['namespace' => 'App\Controllers'/*, 'filter' => 'unregisterAuth'*/], function ($routes) {
    $routes->get('', 'LandingPage_Controller', ['as' => 'landing-page.get']);
});

$routes->group('sign-up', ['namespace' => 'App\Controllers'/*, 'filters' => 'unregisterAuth'*/], function ($routes) {
    $routes ->get('', 'AuthController::signUp', ['as' => 'sign-up.get']);
    $routes->post('', 'AuthController::handleSignUp', ['as' => 'sign-up.post']);
});

$routes->group('sign-in', ['namespace' => 'App\Controllers'/*, 'filters' => 'unregisterAuth'*/], function ($routes) {
    $routes->get('', 'AuthController::signIn', ['as' => 'sign-in.get']);
    $routes->post('', 'AuthController::handleSignIn', ['as' => 'sign-in.post']);
});

$routes->group('home', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'AuthController::signIn', ['as' => 'home.get']);
});

$routes->group('profile', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'AuthController::signIn', ['as' => 'profile.get']);
    $routes->post('', 'AuthController::handleSignIn', ['as' => 'profile.post']);
});

//Faltan las de artist
//Faltan las de album
//Faltan las de playlist
//Faltan las de my playlist

$routes->group('create-playlist', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'PlaylistController::create', ['as' => 'playlist.create']);
    $routes->post('', 'PlaylistController::store', ['as' => 'playlist.store']);
});
//Faltan my playlist management