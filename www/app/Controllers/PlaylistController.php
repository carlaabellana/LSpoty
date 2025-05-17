<?php

namespace App\Controllers;
use App\Entities\Album;
use App\Entities\Track;
use GuzzleHttp\Client;

class PlaylistController extends BaseController
{
    public function show($playlistId)
    {
        helper('form');
        $client   = new Client();

        $playlistUrl = "https://api.jamendo.com/v3.0/playlists/tracks/?client_id=9d42fee4&id=".$playlistId;
        $response = $client->request('GET', $playlistUrl);
        $body = json_decode($response->getBody(), true);

        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Playlist not found");
        }

        $playlist = $body['results'][0];

        $playlistData = [
            'playlist_title' => $playlist['name'],
            'playlist_user'  => $playlist['user_name'],
            'playlist_creationDate' => $playlist['creationdate'],
        ];


        $tracks =[];
        foreach ($playlist['tracks'] as $track) {
            $tracks[] = new Track($track);
        }

        $seconds = array_sum(array_map(fn(Track $t) => $t->duration, $tracks));
        $playlistHours = floor($seconds / 3600);
        $playlistMinutes = floor(($seconds % 3600) / 60);
        $playlistSeconds = $seconds % 60;
        $playlistDuration = ($playlistHours ? $playlistHours . 'h ' : '') . ($playlistMinutes ? $playlistMinutes . 'm ' : '') . $playlistSeconds . 's';

        return view('PlaylistPage', ['playlist' => $playlistData, 'tracks' => $tracks, 'playlistDuration' => $playlistDuration, ]);
    }
}