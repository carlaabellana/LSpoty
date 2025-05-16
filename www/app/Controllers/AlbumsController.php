<?php

namespace App\Controllers;
use GuzzleHttp\Client;

class AlbumsController extends BaseController
{
    public function show($albumId)
    {
        helper('form');
        $client   = new Client();

        $albumUrl = "https://api.jamendo.com/v3.0/albums/?client_id=9d42fee4&id=$albumId";
        $response = $client->request('GET', $albumUrl);
        $body     = json_decode($response->getBody(), true);

        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Album not found");
        }

        $album = $body['results'][0];

        $albumData = [
            'album_Name'               => $album['name'],
            'artist_Name'              => $album['artist_name'],
            'album_Cover'              => $album['image'],
            'album_ReleaseDate'        => $album['releasedate'],
            'album_DisplayReleaseDate' => date('F j, Y', strtotime($album['releasedate'])),
        ];

        $landingPage_data = [
            'releases'     => lang('homepage.releases'),
            'duration'     => lang('homepage.duration'),
        ];

        return view('AlbumPage', $albumData, $landingPage_data);
    }
}