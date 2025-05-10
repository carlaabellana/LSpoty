<?php

namespace App\Controllers;

class AlbumsController extends BaseController
{
    public function show($albumId){
        return "Album Id is $albumId";
    }

}