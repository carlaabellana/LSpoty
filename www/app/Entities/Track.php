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
        'album' => 'album_name',
        'albumId' => 'album_id',
        'duration' => 'duration',
        'playerURL' => 'player_url',
    ];

    /*************************+
     * constructs the Track
     * @param array|null $data: data needed for the track
     * @param string $type
     */
    public function __construct(array $data = null, string $type = 'tracks'){
        parent::__construct();
        if ($type === 'tracks'){
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->cover = $data['image'] ?? null;
            $this->artist = $data['artist_name'] ?? null;
            $this->artistId = $data['artist_id'] ?? null;
            $this->album = $data['album_name'] ?? null;
            $this->albumId = $data['album_id'] ?? null;
            $this->duration = $data['duration'] ?? null;
            $this->playerURL = $data['audio'] ?? null;
            if ($this->album === ""){
                $this->album = "unknown";
            }
        } elseif($type === 'album') {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->duration = $data['duration'] ?? null;
            $this->playerURL = $data['playerURL'] ?? null;
        }
    }

    /************************************
     * sets cover for the tracks in albums
     * @param string $cover: new cover
     * @return void
     */
    public function setCover(string $cover){
        $this->cover = $cover;
    }

    /*********************************
     * Generates the view of a track
     * @param string $type: generates different variants of the track depending on the type of show
     * @return string: the view
     */
    public function generateView(string $type = "album"):string{
        $ImageCover = esc($this->cover);

        $view = '<div class="track">
        <div class="cover">
        <img src="'.$ImageCover.'" alt="Cover for '.$this->name.'">
        </div>
        <div class="infoSpace">
            <p>'.$this->name.'</p>';
        if ($type === 'playlist') {
            $view .= '<div class="info">
                <a href="'.base_url("/artist/".$this->artistId).'">'
                . $this->artist . '</a>
                <a href="'.base_url("/album/".$this->albumId).'">'
                .$this->album.'</a></div>';
        }
        $view .= '</div>';
        if ($type !== 'myPlaylist') {
            $view .= '<div class="PlayTrack">
                <audio>
                    <source src="'.$this->playerURL.'" type = "audio/mpeg">
                </audio>
            </div> <button type="button" class="add" onclick="openPopUp('.$this->id.')">+</button>';
        }
        $view .= '</div>';
        return $view;
    }

}