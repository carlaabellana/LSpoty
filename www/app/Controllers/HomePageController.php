<?php

namespace App\Controllers;
use GuzzleHttp\Client;

class HomePageController extends BaseController
{
    public function index(): string
    {
        helper('form');
        $client = new Client();
        $filter = $_GET['filter'] ?? 'albums';
        $query = $_GET['query'] ?? '';
        $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4";
        $response = $client->request('GET', $apiUrl);
        $body = json_decode($response->getBody(), true);

        return view('HomePage', $body);
    }
}
