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

$routes->group('profile', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'UserPageController::index', ['as' => 'profile.get']);
    $routes->post('', 'UserPageController::profilePost', ['as' => 'profile.post']);
});

//Faltan las de artist post
$routes->get('artist/(:num)', 'ArtistController::show/$1', ['as' => 'artist.get', 'filter' => 'registeredAuth']);

//Faltan las de album post
$routes->get('album/(:num)', 'AlbumsController::show/$1', ['as' => 'album.get', 'filter' => 'registeredAuth']);

$routes->group('playlist/(:num)', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'PlaylistController::show/$1', ['as' => 'playlist.get']);
    $routes->post('', 'PlaylistController::show/$1', ['as' => 'playlist.post']);
});

$routes->group('create-playlist', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'CreatePlaylistController::index', ['as' => 'playlist.create']);
    $routes->post('', 'CreatePlaylistController::storePlaylist', ['as' => 'playlist.store']);
});



$routes->group('my-playlists', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'MyPlaylistsController::index', ['as' => 'my-playlists.index']);
    $routes->get('(:num)', 'MyPlaylistsController::show/$1', ['as' => 'my-playlists.show']);
    $routes->post('(:num)', 'MyPlaylistsController::update/$1', ['as' => 'my-playlists.update']);
    $routes->put('(:num)', 'MyPlaylistsController::upsert/$1', ['as' => 'my-playlists.upsert']);
    $routes->delete('(:num)', 'MyPlaylistsController::delete/$1', ['as' => 'my-playlists.delete']);
    $routes->put('(:num)/track/(:num)', 'MyPlaylistsController::addTrack/$1/$2', ['as' => 'my-playlists.track.add']);
    $routes->delete('(:num)/track/(:num)', 'MyPlaylistsController::removeTrack/$1/$2', ['as' => 'my-playlists.track.remove']);
});

//Librería extra QR
$routes->get('/qr', 'QrController::index');