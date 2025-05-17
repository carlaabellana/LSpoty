<?php

namespace App\Controllers;

use GuzzleHttp\Client;

/**
 * Controller that manages the calling to the API Jamendo to retrieve a certain artist data and its albums. To show
 * them into the artist view.
 */
class ArtistController extends BaseController
{
    /**
     * Method that handles the request to the Jamendo API to show an artist information and its albums.
     *
     * @param $artistId ID of an artist from Jamendo API.
     * @return string HTML view
     * @throws \GuzzleHttp\Exception\GuzzleException Error if the artist is not found.
     */
    public function show($artistId){

        helper('form');

        //HTTP client is initialized to call Jamendo API.
        $client = new Client();

        //URL to ask the Jamendo API the artist information and its albums.
        $artistUrl = 'https://api.jamendo.com/v3.0/artists/albums/?client_id=9d42fee4&id='.$artistId;

        //GET request to the Jamendo API and the decoding of the JSON.
        $response = $client->request('GET', $artistUrl);
        $body     = json_decode($response->getBody(), true);

        //If there are not results or the structure is incorrect, 404 error is showed.
        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artist not found");
        }

        //Artis info is extracted from API.
        $artist = $body['results'][0];

        //The data of the artis is structured to show it.
        $artistData = [
            'artist_Date'              => $artist['name'],
            'artist_image'             => $artist['image'],
            'join_date'                => $artist['joindate'],
            'albumsList'               => $artist['albums'],
        ];

        //the artist wiev is rendered with its data.
        return view('ArtistPage', $artistData);
    }
}