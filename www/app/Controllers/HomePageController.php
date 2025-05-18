<?php

namespace App\Controllers;

use App\Entities\Album;
use App\Entities\Track;

use GuzzleHttp\Client;

/**
 * Controller that manages the homepage, asking to render the HTML based on the user's querys and calling the API
 * Jamendo for the different elements the user wants to see like artists, albums, tracks or playlists.
 */
class HomePageController extends BaseController
{
    /**
     * Method responsible for rendering the homepage. It calls the API for different elements like songs, artists
     * playlists or albums in generic or based on the user's querys. Albums and tracks are stored into their
     * corresponding entities.
     *
     * @return string HTML view
     * @throws \GuzzleHttp\Exception\GuzzleException Exception from API.
     */
    public function index(): string
    {
        helper('form');

        //The Guzzle HTTP client is initialized.
        $client = new Client();

        //The filter & query parameters are retrieved.
        $filter = $_GET['filter'] ?? '';
        $query = $_GET['query'] ?? '';

        //If there is not an specific filter the defaut categories will appear.
        if ($filter === '') {
            //URL we use to call the Jamendo API for different elements (albums, artists & playlists).
            $apiUrl1 = "https://api.jamendo.com/v3.0/albums/?client_id=9d42fee4&limit=9";
            $apiUrl2 = "https://api.jamendo.com/v3.0/artists/?client_id=9d42fee4&limit=9";
            $apiUrl3 = "https://api.jamendo.com/v3.0/playlists/?client_id=9d42fee4&limit=9";

            //If a search query is provided, it is appended to the API URLs.
            if ($query !== '') {
                $apiUrl1 = $apiUrl1."&namesearch=".$query;
                $apiUrl2 = $apiUrl2."&namesearch=".$query;
                $apiUrl3 = $apiUrl3."&namesearch=".$query;
            }

            //The albums are fetched from the API, and the JSON is decoded.
            $response = $client->request('GET', $apiUrl1);
            $body['albums'] = json_decode($response->getBody(), true);

            //Each album is converted into an album entity.
            foreach ($body['albums']['results'] as $key => $album) {
                $album = new Album($album);
                $albums[$key] = $album;
            }
            if (isset($albums)) {
                $body['albums'] = $albums;
            } else {
                $body['albums'] = [];
            }

            //The artists are fetched from the API, and their JSON decoded.
            $response = $client->request('GET', $apiUrl2);
            $body['artists'] = json_decode($response->getBody(), true);

            //The playlists are fetched from the API, and their JSON decoded.
            $response = $client->request('GET', $apiUrl3);
            $body['playlists'] = json_decode($response->getBody(), true);
            $body['playlists']['cover'] = "/IMAGES/playlistCover.jpg";

        }else{
            //This part will be active if the user applies a filter.
            if ($query !== '') {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4&limit=27&namesearch=".$query;
            } else {
                $apiUrl = "https://api.jamendo.com/v3.0/".$filter."/?client_id=9d42fee4&limit=27";
            }

            //The data from the API is fetched and the response of JSON is decoded.
            $response = $client->request('GET', $apiUrl);
            $body = json_decode($response->getBody(), true);

            //If tracks are searched each one of them is stored into a track object.
            if ($filter === 'tracks'){
                $tracks = [];
                foreach ($body['results'] as $key => $track) {
                    $newTrack = new Track($track);
                    $tracks[$key] = $newTrack;
                }
                $body['results'] = $tracks;
            }
        }

        //A singular word label is prepared.
        $size = strlen($filter);
        $filter = substr($filter, 0, ($size-1));
        $body['type'] = $filter;

        //The homepage is rendered with all the data retrieved.
        return view('HomePage', $body);
    }
}
