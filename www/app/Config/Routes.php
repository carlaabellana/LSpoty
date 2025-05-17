<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->group('/', ['namespace' => 'App\Controllers', 'filter' => 'unregisterAuth'], function ($routes) {
    $routes->get('', 'LandingPage_Controller', ['as' => 'landing-page.get']);
});

$routes->group('sign-up', ['namespace' => 'App\Controllers', 'filters' => 'unregisterAuth'], function ($routes) {
    $routes ->get('', 'AuthController::signUp', ['as' => 'sign-up.get']);
    $routes->post('', 'AuthController::handleSignUp', ['as' => 'sign-up.post']);
});

$routes->group('sign-in', ['namespace' => 'App\Controllers', 'filters' => 'unregisterAuth'], function ($routes) {
    $routes->get('', 'AuthController::signIn', ['as' => 'sign-in.get']);
    $routes->post('', 'AuthController::handleSignIn', ['as' => 'sign-in.post']);
});

$routes->post('logout', 'AuthController::logout', ['as' => 'logout.post']);

$routes->group('home', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'HomePageController::index', ['as' => 'home.get']);
});

//$routes->group('profile', ['namespace' => 'App\Controllers'/*, 'filter' => 'registeredAuth'*/], function ($routes) {
//    $routes->get('', 'UserPageController', ['as' => 'profile.get']);
//    $routes->post('', 'UserPageController', ['as' => 'profile.post']);
//});

$routes->group('profile', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'UserPageController::index', ['as' => 'profile.get']);
    $routes->post('', 'UserPageController::profilePost', ['as' => 'profile.post']);
});

//Faltan las de artist
$routes->get('artist/(:num)', 'ArtistController::show/$1', ['as' => 'artist.get', 'filter' => 'registeredAuth']);
//$routes->get('/album', 'AlbumsController::index', ['as' => 'album.get']);
$routes->get('album/(:num)', 'AlbumsController::show/$1', ['as' => 'album.get', 'filter' => 'registeredAuth']);

//Faltan las de playlist

//$routes->get('playlist/(:num)', 'PlaylistsController::show/$1', ['as' => 'playlist.get', 'filter' => 'registeredAuth']);
$routes->group('playlist/(:num)', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'PlaylistController::show/$1', ['as' => 'playlist.get']);
    $routes->post('', 'PlaylistController::show/$1', ['as' => 'playlist.post']);
});

//My playlists
$routes->get('/my-playlists', 'MyPlaylistController::index', ['as' => 'my-playlists.index']);
//Ver una playlist en concreto
$routes->get('/my-playlists/(:num)', 'MyPlaylistController::show/$1');
//Editar una playlist
$routes->post('/my-playlists/(:num)', 'MyPlaylistController::update/$1');
//Eliminar playist
$routes->get('/delete-playlist/(:num)', 'MyPlaylistController::delete/$1');
//AJAX vista dinámica
$routes->get('my-playlists/ajax/(:num)', 'MyPlaylistController::ajax/$1');


$routes->group('create-playlist', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'PlaylistController::create', ['as' => 'playlist.create']);
    $routes->post('', 'PlaylistController::store', ['as' => 'playlist.store']);
});
//Faltan my playlist management

//Librería extra QR
$routes->get('/qr', 'QrController::index');