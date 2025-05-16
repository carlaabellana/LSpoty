<?php

namespace App\Controllers;
use App\Entities\Album;
use App\Entities\Track;
use GuzzleHttp\Client;

class AlbumsController extends BaseController
{
    public function show($albumId)
    {
        helper('form');
        $client   = new Client();

        $albumUrl = "https://api.jamendo.com/v3.0/albums/tracks/?client_id=9d42fee4&id=".$albumId."&include=tracks";
        $response = $client->request('GET', $albumUrl);
        $body     = json_decode($response->getBody(), true);

        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Album not found");
        }

        $albumData = $body['results'][0];
        $albumEntity = new Album($albumData);

        return view('AlbumPage', ['album' => $albumEntity]);
    }
}