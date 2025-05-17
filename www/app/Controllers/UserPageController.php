<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserPageController extends BaseController {

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
    public function profilePost() {
        $session = session();

        if(!$session->get('loggedIn')) {
            return redirect()->route('landing-page.get');
        }

        $userId = $session->get('user_id');
        $userModel = new UserModel();

        $action = $this->request->getPost('action');

        if ($action === 'updateAccount') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $age = $this->request->getPost('age');
            $profilePic = $this->request->getFile('profile_pic');

            $dataToUpdate = [];

            if (!empty($username)) {
                $dataToUpdate['username'] = $username;
            }

            if (!empty($password)) {
                $dataToUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (!empty($age)) {
                $dataToUpdate['age'] = (int)$age;
            }

            if ($profilePic && $profilePic->isValid() && !$profilePic->hasMoved()) {
                $newName = $profilePic->getRandomName();
                $profilePic->move(FCPATH . 'uploads', $newName);
                $dataToUpdate['profile_pic'] = $newName;
            }

            $userModel->update($userId, $dataToUpdate);
            return redirect()->route('profile.get');
        }

        if ($action === 'deleteAccount') {
            $userModel->delete($userId);
            $session->destroy();
            return redirect()->route('landing-page.get');
        }
        return redirect()->route('profile.get');
    }
}