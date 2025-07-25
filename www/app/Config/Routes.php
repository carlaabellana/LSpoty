<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

//Routes relative to the landingPage, allowing to access the sign-in, sign-up and show features.
$routes->group('/', ['namespace' => 'App\Controllers', 'filter' => 'unregisterAuth'], function ($routes) {
    $routes->get('', 'LandingPage_Controller', ['as' => 'landing-page.get']);
});

//routes relative to the sign-up, show page and validate the form.
$routes->group('sign-up', ['namespace' => 'App\Controllers', 'filters' => 'unregisterAuth'], function ($routes) {
    $routes ->get('', 'AuthController::signUp', ['as' => 'sign-up.get']);
    $routes->post('', 'AuthController::handleSignUp', ['as' => 'sign-up.post']);
});

//Routes relative to sign-in, show page and validate the form.
$routes->group('sign-in', ['namespace' => 'App\Controllers', 'filters' => 'unregisterAuth'], function ($routes) {
    $routes->get('', 'AuthController::signIn', ['as' => 'sign-in.get']);
    $routes->post('', 'AuthController::handleSignIn', ['as' => 'sign-in.post']);
});

//This route allows the user to destroy session and log-out.
$routes->post('logout', 'AuthController::logout', ['as' => 'logout.post']);

//Route to show the homepage, controlling the search and showing different elements from the API.
$routes->group('home', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'HomePageController::index', ['as' => 'home.get']);
});

//Routes related to the user that is logged, showing their info and allowing to update this info or destroy the account.
$routes->group('profile', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'UserPageController::index', ['as' => 'profile.get']);
    $routes->post('', 'UserPageController::profilePost', ['as' => 'profile.post']);
});

//Faltan las de artist
$routes->get('artist/(:num)', 'ArtistController::show/$1', ['as' => 'artist.get', 'filter' => 'registeredAuth']);
$routes->post('artist/(:num)', 'ArtistController::handlePost/$1', ['as' => 'artist.post', 'filter' => 'registeredAuth']);

$routes->get('album/(:num)', 'AlbumsController::show/$1', ['as' => 'album.get', 'filter' => 'registeredAuth']);
$routes->post('album/(:num)', 'AlbumsController::handlePost/$1', ['as' => 'album.post', 'filter' => 'registeredAuth']);

//Routes related to the playlists from the API, some actions will be related with my playlists.
$routes->group('playlist/(:num)', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'PlaylistController::show/$1', ['as' => 'playlist.get']);
    $routes->post('', 'PlaylistController::show/$1', ['as' => 'playlist.post']);
});


//My playlists, general view to see all user's playlist, navigate to create a new playlist, navigate to see a playlist or modify a playlist.
$routes->get('/my-playlists', 'MyPlaylistController::index', ['as' => 'my-playlists.index']);
//My playlists, view for a concrete playlist allows to reproduce the data and see all the data of tha user's playlist.
$routes->get('/my-playlists/(:num)', 'MyPlaylistController::concrete/$1', ['as' => 'my-playlists.concrete']);
//My playlists allow to modify the information of a playlist.
$routes->post('/my-playlists/(:num)', 'MyPlaylistController::update/$1');

//Dinalic view for my playlists.
$routes->get('my-playlists/ajax/(:num)', 'MyPlaylistController::ajax/$1');

//AJAX to DELETE a playlist.
$routes->delete('/my-playlists/(:num)', 'MyPlaylistController::delete/$1', ['as' => 'playlist.delete']);

$routes->put('/my-playlists/(:any)/track/(:any)', 'MyPlaylistController::addTrack/$1/$2');


$routes->group('/my-playlists', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
    $routes->get('', 'MyPlaylistController::index', ['as' => 'my-playlists.index']);
    $routes->get('/(:num)', 'MyPlaylistController::show/$1');
    $routes->post('/(:num)', 'MyPlaylistController::update/$1');
    $routes->get('/ajax/(:num)', 'MyPlaylistController::ajax/$1');
    $routes->delete('/(:num)', 'MyPlaylistController::delete/$1', ['as' => 'playlist.delete']);
});

//$routes->put()

//Routes related to create a playlist and to save it into the DB. ->POST
//$routes->group('create-playlist', ['namespace' => 'App\Controllers', 'filter' => 'registeredAuth'], function ($routes) {
//    $routes->get('', 'CreatePlaylistController::create', ['as' => 'playlist.create']);
//    $routes->post('', 'CreatePlaylistController::store', ['as' => 'playlist.store']);
//});
$routes->put('/my-playlists/(:segment)', 'MyPlaylistController::put/$1');

//AJAX to CREATE a playlist
$routes->match(['put', 'post'], '/my-playlists/(:segment)', 'MyPlaylistController::put/$1');
$routes->get('/create-playlist', 'MyPlaylistController::createForm', ['as' => 'playlist.create', 'filter' => 'registeredAuth']);
$routes->post('/create-playlist', 'MyPlaylistController::createForm', ['as' => 'playlist.create.post']);

//Save a playlist from Jamendo.
$routes->post('/save-from-jamendo/(:segment)', 'MyPlaylistController::saveFromJamendo/$1');

//External Library to add QR.
$routes->get('/qr', 'QrController::index');
