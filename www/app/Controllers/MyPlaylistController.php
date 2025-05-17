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
        $userId     = $session->get('user_id');
        $userModel = new UserModel();
        $user       = $userModel->find($userId);

        //Obtener playlists del usuario
        $playlistModel = new PlaylistModel();
        $playlists     = $playlistModel->where('user_id', $userId)->findAll();

        return view('MyPlaylists', ['playlists' => $playlists]);
    }
    public function show($id)
    {
        $session = session();
        if (!$session->get('loggedIn')) {
            return redirect()->route('landing-page.get');
        }

        $playlistModel = new PlaylistModel();
        $playlist = $playlistModel->find($id);

        if (!$playlist || $playlist['user_id'] !== $session->get('user_id')) {
            return redirect()->to('/my-playlists')->with('error', 'Playlist not found');
        }

        return view('MyPlaylists/show', ['playlist' => $playlist]);
    }

    public function update($id)
    {
        $playlistModel = new PlaylistModel();
        $playlistModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/my-playlists/' . $id)->with('success', 'Playlist updated');
    }

    public function delete($id)
    {
        $playlistModel = new PlaylistModel();
        $playlistModel->delete($id);

        return redirect()->to('/my-playlists')->with('success', 'Playlist deleted');
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

}