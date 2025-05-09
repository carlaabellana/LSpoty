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
    $routes->get('', 'HomePageController::index', ['as' => 'home.get']);
});

$routes->group('profile', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'UserPageController::index', ['as' => 'profile.get']);
    $routes->post('', 'UserPageController::profilePost', ['as' => 'profile.post']);
});

//Revisar a partir de aquí en caso de ser necesario

$routes->group('artist', ['namespace' => 'App\Controllers\API'], function($routes) {
    $routes->get('/(:num)', 'ArtistController::show/$1', ['as' => 'artist.get']);
    $routes->post('/(:num)', 'ArtistController::update/$1', ['as' => 'artist.update']);
});

$routes->group('album', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/(:num)', 'AlbumController::show/$1', ['as' => 'album.get']);
    $routes->post('/(:num)', 'AlbumController::update/$1', ['as' => 'album.update']);
});

$routes->group('playlist', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/(:num)', 'PlaylistController::show/$1', ['as' => 'playlist.get']);
    $routes->post('/(:num)', 'PlaylistController::update/$1', ['as' => 'playlist.update']);
});

$routes->group('my-playlists', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('', 'MyPlaylistsController::index', ['as' => 'my-playlists.get']);
    $routes->get('/(:num)', 'MyPlaylistsController::show/$1', ['as' => 'my-playlists.get']);
    $routes->post('/(:num)', 'MyPlaylistsController::update/$1', ['as' => 'my-playlists.update']);
});

$routes->group('create-playlist', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
    $routes->get('', 'PlaylistController::create', ['as' => 'playlist.create']);
    $routes->post('', 'PlaylistController::store', ['as' => 'playlist.store']);
});

//Faltan my playlist management