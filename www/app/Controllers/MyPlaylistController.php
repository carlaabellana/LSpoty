<?php

namespace App\Controllers;

use App\Entities\Track;
use App\Models\PlaylistModel;
use App\Models\TrackModel;
use App\Models\UserModel;
use GuzzleHttp\Client;


class MyPlaylistController extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('loggedIn')) {
            return redirect()->route('landing-page.get');
        }
//Obtener los datos del usuario
        $userId = $session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

//Obtener playlists del usuario
        $playlistModel = new PlaylistModel();
        $playlists = $playlistModel->where('user_id', $userId)->findAll();

        return view('MyPlaylists', ['playlists' => $playlists]);
    }
    public function update($id)
    {
        $playlistModel = new PlaylistModel();

        $retrievedData = [
            'name'  => $this->request->getPost('name'),
        ];

        $file = $this->request->getFile('cover');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $newName);

            $retrievedData['cover'] = $newName;
        }

        $playlistModel->update($id, $retrievedData);

        return redirect()->to('/my-playlists')->with('success', 'Playlist updated');
    }
    public function delete($id)
    {
        $session = session();

        if (!$session->get('loggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Not authorized']);
        }

        $playlistModel = new PlaylistModel();
        $playlist = $playlistModel->find($id);

        if (!$playlist || $playlist['user_id'] !== $session->get('user_id')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Access denied']);
        }

        $playlistModel->delete($id);

        return $this->response->setJSON(['success' => true, 'message' => 'Playlist deleted']);
    }

// dashboard dinámico
    public function ajax($id)
    {
        $session = session();
        $playlistModel = new PlaylistModel();
        $playlist = $playlistModel->find($id);

        if (!$playlist || $playlist['user_id'] !== $session->get('user_id')) {
            return $this->response->setStatusCode(403)->setBody('Access denied');
        }
        return view('MyPlaylists_detail', ['playlist' => $playlist]);
    }
//Añadir playlist creada por nosotras
    public function put($id)
    {
        $session = session();
        if (!$session->get('loggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized']);
        }

        $playlistModel = new PlaylistModel();
        $userId = $session->get('user_id');

//Datos del formulario
        $playlistName = $this->request->getVar('playlist_name');
        $playlistImage = $this->request->getFile('playlist_image');

        if (empty($playlistName)) {
            return $this->response->setStatusCode(422)->setJSON(['error' => 'El nombre es obligatorio']);
        }

        if ($playlistImage && $playlistImage->isValid() && !$playlistImage->hasMoved()) {
            $newName = $playlistImage->getRandomName();
            $playlistImage->move(FCPATH . 'uploads', $newName);
            $coverPath = $newName;
        } else {
            $coverPath = 'IMAGES/playlistCover.jpg';
        }

        $playlistModel->insert([
            'id' => $id,
            'name' => $playlistName,
            'cover' => $coverPath,
            'user_id' => $userId
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Playlist creada']);
    }
    public function createForm()
    {
        return view('CreatePlaylistPage');
    }
    public function saveFromJamendo($id)

    {
        log_message('debug', 'SAVE JAMENDO: ' . json_encode($this->request->getVar()));

        $session = session();

        if (!$session->get('loggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized']);
        }

        $playlistModel = new PlaylistModel();
        $userId = $session->get('user_id');

// Verificamos si la playlist ya está guardada
        if ($playlistModel->find($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'La playlist ya está guardada']);
        }

        $playlistName = $this->request->getVar('playlist_name');
        $coverUrl = $this->request->getVar('cover_url');

        if (empty($playlistName)) {
            return $this->response->setStatusCode(422)->setJSON(['error' => 'El nombre es obligatorio']);
        }

        $coverPath = $coverUrl ?: 'IMAGES/playlistCover.jpg';

        $playlistModel->insert([
            'id' => $id,
            'name' => $playlistName,
            'cover' => $coverPath,
            'user_id' => $userId
        ]);
        return $this->response->setJSON(['success' => true, 'message' => 'Playlist de Jamendo guardada correctamente']);
    }

    /**********************
     * adds a track to the asigned playlist
     * @param $idPlaylist: id of the playlist where we want to save
     * @param $idTrack: id of the track we want to save
     */
    public function addTrack($idPlaylist, $idTrack){
        $data = json_decode($this->request->getBody(), true)??[];
        $track = new TrackModel();
        $client = new Client();
        $apiUrl = "https://api.jamendo.com/v3.0/tracks/?client_id=9d42fee4&id=".$idTrack;
        $response = $client->request('GET', $apiUrl);
        $body = json_decode($response->getBody(), true);
        $newTrack = new Track($body['results'][0]);
        $trak = [
            'id' => $newTrack->id,
            'name' => $newTrack->name,
            'cover' => $newTrack->cover,
            'artist_name' => $newTrack->artist,
            'artist_id' => $newTrack->artistId,
            'album_name' => $newTrack->album,
            'album_id' => $newTrack->albumId,
            'duration' => $newTrack->duration,
            'player_url' =>$newTrack->playerURL,
            'playlist_id' => $idPlaylist,
        ];

        $track->insert($trak);

        return $this->response->setStatusCode(200)->setJson(['responseData' => 'All es gut']);
    }

    public function concrete($id) {

        if ($id === null) {
            throw PageNotFoundException::forPageNotFound("The playlist does not exsist.");
        }

        //The id of the user is searched to link it to the playlist.
        $session = session();
        $userId = $session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        $username  = $user['username'] ?? $user['email'] ?? 'Unknown User';

        //The playlist is retrieved based on its id and the user's ID.
        $playlistModel = new PlaylistModel();
        $playlist = $playlistModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
        if (! $playlist) {
            throw PageNotFoundException::forPageNotFound("Playlist not found.");
        }

        //We create a track model for each track of playlist.
        $trackModel = new TrackModel();
        $tracks = $trackModel
            ->where('playlist_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();

        //The duration is calculated.
        $totalSeconds = array_sum(array_column($tracks, 'duration'));

        $hours   = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        $formattedDuration = '';
        if ($hours)   $formattedDuration .= $hours   . 'h ';
        if ($minutes) $formattedDuration .= $minutes . 'm ';
        $formattedDuration .= $seconds . 's';

        //The data is introduced in the variable to send it to the view.
        $data = [
            'playlist_title'        => $playlist['name'],
            'playlist_user'         => $username,
            'playlist_creationDate' => date('Y-m-d', strtotime($playlist['created_at'])),
            'playlistDuration'      => $formattedDuration,
            'cover'                 => $playlist['cover'],
            'tracks'                => $tracks,
        ];

        return view('MyPlaylistsView', $data);
    }

}