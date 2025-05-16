<?php

namespace App\Entities;
use CodeIgniter\Entity\Entity;
class Album extends Entity
{
    protected $dates = [];
    protected $attributes = [
        'id' => "0",
        'name' => null,
        'cover' => null,
        'artist' => null,
        'release_date' => null,
        'tracks' => [],
        'total_duration' => 0,
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'cover' => 'string',
        'artist' => 'string',
        'artistId' => 'string',
        'release_date' => 'datetime',
        'tracks' => 'array',
        'total_duration' => 'integer',
    ];

    public function __construct(array $data = null) {
        parent::__construct();
        $this->id = $data['id'] ?? '0';
        $this->name = $data['name'] ?? '';
        $this->cover = $data['image'] ?? '/IMAGES/playlistCover.jpg';
        $this->artist = $data['artist_name'] ?? 'unknown';
        $this->artistId = $data['artist_id'] ?? '0';
        $this->release_date = $data['releasedate'] ?? '';
        if (isset($data['tracks'])) {
            foreach ($data['tracks'] as $key => $track) {
                $track = new Track($track, "album");
                $track->setCover($this->cover);
                $this->total_duration += $track->duration;
                $tracks[$key] = $track;
            }
            $this->tracks = $tracks;
        }

    }

//    public function getId() : string {
//        return $this->id;
//    }
//
//    public function getName() {
//        return $this->name;
//    }
//    public function getCover() {
//        return $this->cover;
//    }
//    public function getArtist() {
//        return $this->artist;
//    }
//    public function getArtistId() {
//        return $this->artistId;
//    }
//    public function getReleaseDate() {
//        return $this->release_date;
//    }


    public function generateTrackView(): string {
        $view = '<div style="background-color: #dd4814"> start  ';
        foreach ($this->tracks as $track) {
            //$view = $view . $track->generateView('album');
            $view .= $track->generateView('album');
        }
        $view = $view . '</div>';
        return $view;
    }



}
