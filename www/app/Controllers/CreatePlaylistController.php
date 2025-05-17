<?php

namespace App\Controllers;
use App\Entities\Album;
use App\Entities\Track;
use GuzzleHttp\Client;

class CreatePlaylistController extends BaseController
{
    public function index()
    {
        return view('CreatePlaylistPage');
    }
}