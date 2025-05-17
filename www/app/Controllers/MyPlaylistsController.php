<?php

namespace App\Controllers;
use App\Entities\Album;
use App\Entities\Track;
use GuzzleHttp\Client;

class MyPlaylistsController extends BaseController
{
    public function index() {
        return view('MyPlaylistsView');
    }
}