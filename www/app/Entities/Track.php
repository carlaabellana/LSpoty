<?php

namespace App\Entities;
use CodeIgniter\Entity\Entity;
class Track extends Entity
{
    protected $dates = [];
    protected $attributes = [
        'id' => null,
        'name' => null,
        'cover' => null,
        'artist' => null,
        'artistId' => null,
        'album' => null,
        'albumId' => null,
        'duration' => null,
        'playerURL' => null,
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'cover' => 'string',
        'artist' => 'string',
        'artistId' => 'string',
        'album' => 'string',
        'albumId' => 'string',
        'duration' => 'integer',
        'playerURL' => 'string',
    ];

    protected $datamap = [
        'id' => 'id',
        'name' => 'name',
        'cover' => 'image',
        'artist' => 'artist_name',
        'artistId' => 'artist_id',
        'album' => 'album',
        'albumId' => 'album_id',
        'duration' => 'duration',
        'playerURL' => 'audio',
    ];

    public function __construct(array $data = null, string $type = 'tracks'){
        parent::__construct();
        if ($type === 'tracks'){
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->cover = $data['image'] ?? null;
            $this->artist = $data['artist_name'] ?? null;
            $this->artistId = $data['artist_id'] ?? null;
            $this->album = $data['album'] ?? null;
            $this->albumId = $data['album_id'] ?? null;
            $this->duration = $data['duration'] ?? null;
            $this->playerURL = $data['audio'] ?? null;
        } elseif($type === 'album') {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->duration = $data['duration'] ?? null;
            $this->playerURL = $data['playerURL'] ?? null;
        }
    }

    public function setCover(string $cover){
        $this->cover = $cover;
    }

    public function generateView(string $type = "album"):string{
        $ImageCover = esc($this->cover);

        $view = '<div class="track">
        <div class="cover">
        <img src="'.$ImageCover.'" alt="Cover for '.$this->name.'">
        </div>
        <div class="infoSpace">
            <p>'.$this->name.'</p>';
        if ($type === 'playlist') {
            $view .= '<div class="info"><p>' . $this->artist . '</p><p>'.$this->album.'</p></div>';
        }
        $view .= '</div>';
        if ($type !== 'myPlaylist') {
            $view .= '<div class="PlayTrack">
                <audio>
                    <source src="'.$this->playerURL.'" type = "audio/mpeg">
                </audio>
            </div> <button class="add">+</button>';
        }
        $view .= '</div>';
        return $view;
    }

}