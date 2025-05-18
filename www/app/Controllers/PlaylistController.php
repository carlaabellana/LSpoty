<?php

namespace App\Controllers;

use App\Entities\Track;

use App\Models\PlaylistModel;
use GuzzleHttp\Client;

/**
 * Controller that manages the visualization of a certain playlist. We ask the Jamendo API for its information and
 * collect each track into a track Entity.
 */
class PlaylistController extends BaseController
{
    /**
     * Method that will display a certain playlist, its information and its tracks from Jamendo API.
     *
     * @param $playlistId ID of the playlist to show from the Jamendo API.
     * @return string HTML with the playlist view
     * @throws \GuzzleHttp\Exception\GuzzleException Error if playlist is not found.
     */
    public function show($playlistId)
    {
        helper('form');

        //Guzzle HTTP client is instantiated.
        $client   = new Client();

        //The Jamendo API URL is built to retrieve a playlist and its tracks.
        $playlistUrl = "https://api.jamendo.com/v3.0/playlists/tracks/?client_id=9d42fee4&id=".$playlistId;

        //We GET the response and decode the JSON response.
        $response = $client->request('GET', $playlistUrl);
        $body = json_decode($response->getBody(), true);

        //Error in case the playlist is not found.
        if (empty($body['results']) || !isset($body['results'][0])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Playlist not found");
        }

        //The playlist is extracted and its data is collected to show it into the view.
        $playlist = $body['results'][0];
        $playlistData = [
            'playlist_title' => $playlist['name'],
            'playlist_user'  => $playlist['user_name'],
            'playlist_creationDate' => $playlist['creationdate'],
        ];

        //Each track of the playlist is converted into a track Entity.
        $tracks =[];
        foreach ($playlist['tracks'] as $track) {
            $tracks[] = new Track($track);
        }

        //we calculate the duration of the playlist formated in h, min, sec.
        $seconds = array_sum(array_map(fn(Track $t) => $t->duration, $tracks));
        $playlistHours = floor($seconds / 3600);
        $playlistMinutes = floor(($seconds % 3600) / 60);
        $playlistSeconds = $seconds % 60;
        $playlistDuration = ($playlistHours ? $playlistHours . 'h ' : '') . ($playlistMinutes ? $playlistMinutes . 'm ' : '') . $playlistSeconds . 's';

        //Reading the names and ids of the user's playlist
        $session = session();
        $playlistsModel = new PlaylistModel();
        $names = $playlistsModel->where('user_id', $session->get('user_id'))->findColumn('name');
        $ids = $playlistsModel->where('user_id', $session->get('user_id'))->findColumn('id');


        //The view is returned with all the data collected and needed to show.
        return view('PlaylistPage', ['playlist' => $playlistData, 'tracks' => $tracks, 'playlistDuration' => $playlistDuration,'playlistId' => $playlistId , 'PlaylistNames' => $names, 'PlaylistIds' => $ids]);
    }
}