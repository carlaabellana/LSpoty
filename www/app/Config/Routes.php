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

$routes->post('logout', 'AuthController::logout', ['as' => 'logout.post']);

$routes->group('home', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'HomePageController::index', ['as' => 'home.get']);
});

//$routes->group('profile', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
//    $routes->get('', 'UserPageController', ['as' => 'profile.get']);
//    $routes->post('', 'UserPageController', ['as' => 'profile.post']);
//});

$routes->get('/profile', 'UserPageController::index', ['as' => 'profile.get']);
$routes->post('/profile', 'UserPageController::profilePost', ['as' => 'profile.post']);

//Faltan las de artist
$routes->get('artist/(:num)', 'ArtistController::show/$1', ['as' => 'artist.get']);
//Faltan las de album

//$routes->get('/album', 'AlbumsController::index', ['as' => 'album.get']);
$routes->get('album/(:num)', 'AlbumsController::show/$1', ['as' => 'album.get']);
//Faltan las de playlist
$routes->get('playlist/(:num)', 'PlaylistsController::show/$1', ['as' => 'playlist.get']);
//Faltan las de my playlist

$routes->group('create-playlist', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'PlaylistController::create', ['as' => 'playlist.create']);
    $routes->post('', 'PlaylistController::store', ['as' => 'playlist.store']);
});
//Faltan my playlist management