<?php

namespace App\Entities;
class Track
{
    private $id;
    private $name;
    private $cover;
    private $artist;
    private $artistID;
    private $album;
    private $albumID;
    private $duration;

    private $playerURL;


    public function __construct($id, $name, $cover, $artist, $artistID, $album, $albumID, $duration, $playerURL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cover = $cover;
        $this->artist = $artist;
        $this->artistID = $artistID;
        $this->album = $album;
        $this->albumID = $albumID;
        $this->duration = $duration;
        $this->playerURL = $playerURL;

    }

}