<?php

namespace App\Controllers;

use App\Models\PlaylistModel;

/**
 * Controller that will manage the creation of a new playlist made by the user. The corresponding errors are handled.
 * and it will be stored into the DB if all fields are valid. The controller also manages showing the view.
 */
class CreatePlaylistController extends BaseController
{
    /**
     * Method that displays the creation playlist form. With a flash data in case we need to use it.
     *
     * @return string HTML content
     */
    public function create()
    {
        $errors = session()->getFlashdata('errors') ?? [];
        return view('CreatePlaylistPage', ['errors' => $errors]);
    }

    /**
     * Method that handles the playlist creation form, managing the validation data. In success we save the new playlist
     * into the database.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirection to the form with errors.
     * @throws \ReflectionException If model validation fails.
     */
    public function store()
    {
        //Array to store the errors of the view.
        $errors = [];

        //Session is collected and we collect the user ID for further use.
        $session = session();
        $userId = $session->get('user_id');

        //Model to save the playlist.
        $playlistModel = new PlaylistModel();

        //Info is retrieved from the form inputs
        $playlistName = $this->request->getPost('playlist_name');
        $playlistImage = $this->request->getFile('playlist_image');

        //Error in case the name is empty.
        if (empty($playlistName)) {
            $errors['playlist_name'] = lang('homepage.err_crate_p_title');
        }

        //Error to validate the image
        if ($playlistImage && $playlistImage->isValid() && !$playlistImage->hasMoved()) {
            $maxSize = 2 * 1024 * 1024;
            $extension = strtolower($playlistImage->getClientExtension());
            $allowed = ['jpg', 'jpeg', 'png'];

            //Error the extension must be one of the registered.
            if (!in_array($extension, $allowed)) {
                $errors['playlist_image'] = lang('register.invalid_extension');
            //Error in case the image is too big.
            } elseif ($playlistImage->getSize() > $maxSize) {
                $errors['playlist_image'] = lang('register.file_too_large');
            //If all checks are correct the file will be saved and its name changed.
            } else {
                $newName = $playlistImage->getRandomName();
                $playlistImage->move(FCPATH . 'uploads', $newName);
                $playlistPicPath = $newName;
            }
        //If there is no image it will be default.
        } else {
            $playlistPicPath = 'IMAGES/playlistCover.jpg';
        }

        //If there are errors, we redirect showing them into the view.
        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        //The new playlist will be saved into the database.
        $playlistModel->save([
            'name' => $playlistName,
            'cover' => $playlistPicPath,
            'user_id' => $userId,
        ]);

        //Success message in case all the process was OK.
        $session->setFlashdata('success', lang('register.succ_create_p'));
        //Redirection to my-playlists.
        return redirect()->route('my-playlists.index');
    }
}