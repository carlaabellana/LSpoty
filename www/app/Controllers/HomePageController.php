<?php

namespace App\Controllers;
use GuzzleHttp\Client;

class HomePageController extends BaseController
{
    public function index(): string
    {
        helper('form');
        $client = new Client();
        $filter = $_GET['filter'] ?? '';
        $query = $_GET['query'] ?? '';
        //$data = [];
        //$data['albums'] = [];
        //$data['artists'] = [];
        //$data['playlists'] = [];
        if ($filter === '') {
            $apiUrl1 = "https://api.jamendo.com/v3.0/albums/?client_id=9d42fee4";
            $apiUrl2 = "https://api.jamendo.com/v3.0/artists/?client_id=9d42fee4";
            $apiUrl3 = "https://api.jamendo.com/v3.0/playlists/?client_id=9d42fee4";

            if ($query !== '') {
                $apiUrl1 = $apiUrl1."&namesearch=".$query;
                $apiUrl2 = $apiUrl2."&namesearch=".$query;
                $apiUrl3 = $apiUrl3."&namesearch=".$query;
            }

            $response = $client->request('GET', $apiUrl1);
            $body['albums'] = json_decode($response->getBody(), true);
            $response = $client->request('GET', $apiUrl2);
            $body['artists'] = json_decode($response->getBody(), true);
            $response = $client->request('GET', $apiUrl3);
            $body['playlists'] = json_decode($response->getBody(), true);
            $body['playlists']['cover'] = "/IMAGES/playlistCover.jpg";

        }else{
            if ($query !== '') {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4&namesearch=".$query;
            } else {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4";
            }
            $response = $client->request('GET', $apiUrl);
            $body = json_decode($response->getBody(), true);
        }

        $body['type'] = $filter;
        //echo implode( " ", $body['albums']['results'][0]);
        return view('HomePage', $body);
    }
}
