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

    /**************************
     * Takes the month from release date returns the month in the correct language
     * @return string:month in correct language
     */
    public function monthLanguage(): string
    {
        $dateAlbum = $this->release_date;

        $monthAlbum = (int) $dateAlbum->format('m');

        return lang("homepage.month_{$monthAlbum}");
    }

    /*******************************
     * Converts the given duration to a min/hour/sec format
     * @return string:final form of duration
     */
    public function getFormatDuration(): string
    {
        $seconds = $this->total_duration;
        $albumHours = floor($seconds / 3600);
        $albumMinutes = floor(($seconds % 3600) / 60);
        $albumSeconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $albumHours, $albumMinutes, $albumSeconds);
    }

    /********************************************
     * Constructs a new Album
     * @param array|null $data: information
     */
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

    /*************************
     * Returns a view with all the tracks automatically made
     * @return string: view
     */
    public function generateTrackView(): string {
        $view = '<div> ';
        foreach ($this->tracks as $track) {
            $view .= $track->generateView('album');
        }
        $view = $view . '</div>';
        return $view;
    }



}
