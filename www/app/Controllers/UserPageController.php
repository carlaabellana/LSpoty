<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

/**
 * controller that manages showing the user profile and controls the form. If the user wants to edit its data this
 * controller manages the form and its errors. If all is a success the new data will be stored into the DB. We also
 * manage the delete of the account.
 */
class UserPageController extends BaseController {

    /**
     * The user profile page is rendered, the user data will be shown. If the mode of edit is 1 the view changes to show
     * a form to update the user data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string HTML with the view.
     */
    public function index() {

        $session = session();

        //The data of the user in session is collected by its ID and the information is collected from User Model.
        $userId = $session->get('user_id');
        $userModel = new UserModel();
        $user      = $userModel->find($userId);
        $userPage_data = [
            'username'        => $user['username'],
            'email'           => $user['email'],
            'age'             => $user['age'],
            'profile_pic'     => $user['profile_pic'],
        ];

        //We check if the edit mode is activated before rendering.
        $editUserMode = $this->request->getGet('edit') === '1';

        //The user profile view is rendered.
        return view('UserPage', ['userPage_data' => $userPage_data, 'editUserMode' => $editUserMode,]);
    }

    /**
     * Method that handles the form to edit the user data. Showing the corresponding errors. If there are not errors
     * the new info will be saved into the DB. The method manages the delete of the account.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse HTML view.
     * @throws \ReflectionException
     */
    public function profilePost() {
        $session = session();

        //The user ID is collected  and the UserModel instantiated.
        $userId = $session->get('user_id');
        $userModel = new UserModel();

        //Action of the form.
        $action = $this->request->getPost('action');

        //The account updating is managed, we get the new data.
        if ($action === 'updateAccount') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $age = $this->request->getPost('age');
            $profilePic = $this->request->getFile('profile_pic');

            //An array is prepared to store the new data and to store it.
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

            //The DB is updated with the new data.
            $userModel->update($userId, $dataToUpdate);

            //Redirection to the profile page.
            return redirect()->route('profile.get');
        }

        //Here we handle the account delete.
        if ($action === 'deleteAccount') {
            $userModel->delete($userId);
            $session->destroy();
            return redirect()->route('landing-page.get');
        }
        //Redirection to profile page.
        return redirect()->route('profile.get');
    }
}