<?php

namespace App\Controllers;

use App\Models\PlaylistModel;
use CodeIgniter\Controller;
use App\Models\UserModel;


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

}