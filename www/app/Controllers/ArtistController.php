<?php

namespace App\Controllers;
use GuzzleHttp\Client;

class ArtistController extends BaseController
{
    public function show($artistId){
        helper('form');
        $client = new Client();

        $artistUrl = 'https://api.jamendo.com/v3.0/artists/albums/?client_id=9d42fee4&id='.$artistId;
        $response = $client->request('GET', $artistUrl);
        $body     = json_decode($response->getBody(), true);

        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artist not found");
        }
        $artist = $body['results'][0];

        $artistData = [
            'artist_Date'              => $artist['name'],
            'artist_image'             => $artist['image'],
            'join_date'                => $artist['joindate'],
            'albumsList'               => $artist['albums'],
        ];
    return view('ArtistPage', $artistData);
    }
}