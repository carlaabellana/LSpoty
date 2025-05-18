<?php

namespace App\Controllers;

use App\Entities\Album;

use App\Models\PlaylistModel;
use GuzzleHttp\Client;

/**
 * Controller that will manage the page to show a certain album. We manage call to Jamendo API and save the album into
 * an entity.
 */
class AlbumsController extends BaseController
{
    /**
     * Method that displays a specific album and the tracks it contains.
     *
     * @param $albumId ID of the album obtained from Jamendo API.
     * @return string HTTP response.
     * @throws \GuzzleHttp\Exception\GuzzleException Exception in case the album is not found.
     */
    public function show($albumId)
    {
        helper('form');

        //New  Guzzle client for HTTP requests.
        $client   = new Client();

        //Jamendo API url to search the requested data.
        $albumUrl = "https://api.jamendo.com/v3.0/albums/tracks/?client_id=9d42fee4&id=".$albumId."&include=tracks";

        //GET request sended to Jamendo, and decodification of the JSON response.
        $response = $client->request('GET', $albumUrl);
        $body     = json_decode($response->getBody(), true);

        //If the album is not found or the response is invalid, 404 error is shown.
        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Album not found");
        }

        //The album data is converted in an Album entity.
        $albumData = $body['results'][0];
        $albumEntity = new Album($albumData);

        //Reading the names and ids of the user's playlist
        $session = session();
        $playlistsModel = new PlaylistModel();
        $names = $playlistsModel->where('user_id', $session->get('user_id'))->findColumn('name');
        $ids = $playlistsModel->where('user_id', $session->get('user_id'))->findColumn('id');

        //The AlbumPage view ir rendered with the Album entity data.
        return view('AlbumPage', ['album' => $albumEntity, 'PlaylistNames' => $names, 'PlaylistIds' => $ids]);
    }
}