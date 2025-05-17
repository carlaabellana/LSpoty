<?php

namespace App\Controllers;
use App\Models\PlaylistModel;

class CreatePlaylistController extends BaseController
{
    public function create()
    {
        $errors = session()->getFlashdata('errors') ?? [];
        return view('CreatePlaylistPage', ['errors' => $errors]);
    }

    public function store()
    {
        $errors = [];

        $session = session();
        $userId = $session->get('user_id');
        $playlistModel = new PlaylistModel();

        $playlistName = $this->request->getPost('playlist_name');
        $playlistImage = $this->request->getFile('playlist_image');

        if (empty($playlistName)) {
            $errors['playlistname'] = lang('homepage.err_crate_p_title');
        }

        if ($playlistImage && $playlistImage->isValid() && !$playlistImage->hasMoved()) {
            $maxSize = 2 * 1024 * 1024;
            $extension = strtolower($playlistImage->getClientExtension());
            $allowed = ['jpg', 'jpeg', 'png'];

            if (!in_array($extension, $allowed)) {
                $errors['playlistimage'] = lang('register.invalid_extension');
            } elseif ($playlistImage->getSize() > $maxSize) {
                $errors['playlistimage'] = lang('register.file_too_large');
            } else {
                $newName = $playlistImage->getRandomName();
                $playlistImage->move(FCPATH . 'uploads', $newName);
                $playlistPicPath = $newName;
            }
        } else {
            $playlistPicPath = null;
        }

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $playlistModel->save([
            'name' => $playlistName,
            'cover' => $playlistPicPath,
            'user_id' => $userId,
        ]);

        $session->setFlashdata('success', lang('register.succ_create_p'));
        return redirect()->route('my-playlists.index');
    }
}