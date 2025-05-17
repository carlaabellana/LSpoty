<?php

namespace App\Controllers;
use App\Entities\Album;
use App\Entities\Track;
use GuzzleHttp\Client;

class HomePageController extends BaseController
{
    public function index(): string
    {
        helper('form');
        $client = new Client();
        $filter = $_GET['filter'] ?? '';
        $query = $_GET['query'] ?? '';

        if ($filter === '') {
            $apiUrl1 = "https://api.jamendo.com/v3.0/albums/?client_id=9d42fee4&limit=9";
            $apiUrl2 = "https://api.jamendo.com/v3.0/artists/?client_id=9d42fee4&limit=9";
            $apiUrl3 = "https://api.jamendo.com/v3.0/playlists/?client_id=9d42fee4&limit=9";

            if ($query !== '') {
                $apiUrl1 = $apiUrl1."&namesearch=".$query;
                $apiUrl2 = $apiUrl2."&namesearch=".$query;
                $apiUrl3 = $apiUrl3."&namesearch=".$query;
            }

            $response = $client->request('GET', $apiUrl1);
            $body['albums'] = json_decode($response->getBody(), true);
            foreach ($body['albums']['results'] as $key => $album) {
                $album = new Album($album);
                $albums[$key] = $album;
            }
            if (isset($albums)) {
                $body['albums'] = $albums;
            } else {
                $body['albums'] = [];
            }

            $response = $client->request('GET', $apiUrl2);
            $body['artists'] = json_decode($response->getBody(), true);
            $response = $client->request('GET', $apiUrl3);
            $body['playlists'] = json_decode($response->getBody(), true);
            $body['playlists']['cover'] = "/IMAGES/playlistCover.jpg";

        }else{
            if ($query !== '') {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4&limit=27&namesearch=".$query;
            } else {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4&limit=27";
            }
            $response = $client->request('GET', $apiUrl);
            $body = json_decode($response->getBody(), true);
            if ($filter === 'tracks'){
                $tracks = [];
                foreach ($body['results'] as $key => $track) {
                    $newTrack = new Track($track);
                    $tracks[$key] = $newTrack;
                }
                $body['results'] = $tracks;
            }
        }

        $size = strlen($filter);
        $filter = substr($filter, 0, ($size-1));
        $body['type'] = $filter;

        return view('HomePage', $body);
    }
}
