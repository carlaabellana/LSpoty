<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserPageController extends Controller {

    public function index() {
        $session = session();

        if(!$session->get('loggedIn')) {
            return redirect()->route('landing-page.get');
        }

        $userId = $session->get('user_id');
        $userModel = new UserModel();
        $user      = $userModel->find($userId);
        $userPage_data = [
            'username'        => $user['username'],
            'email'           => $user['email'],
            'age'             => $user['age'],
            'profile_pic'     => $user['profile_pic'],
        ];

        $editUserMode = $this->request->getGet('edit') === '1';
        return view('UserPage', ['userPage_data' => $userPage_data, 'editUserMode' => $editUserMode,]);

    }
}