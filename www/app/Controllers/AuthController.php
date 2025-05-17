<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

/**
 * Controller that handles the sign in and login of the user. It handles the corresponding forms and errors. If the user
 * in register is correct it is stored into the DB. If the log in is correct the user goes to home with the session
 * initialized. The controller also handles the log out.
 */
class AuthController extends BaseController
{
    /**
     * Method that returns the registration form with empty errors and the user data.
     *
     * @return string HTML view.
     */
    public function signUpGet()
    {
        return view('SignUp', ['errors' => [], 'old' => []]);
    }


    /**
     * Method that returns the album with the validation errors.
     *
     * @return string HTML view
     */
    public function signUp()
    {
        //Pass validation services.
        return view('signUp', ['validation' => \Config\Services::validation(),]);
    }

    /**
     * Method that handles the form submission, controlling and showing the corresponding errors. If there aren't errors
     * the information will be saved into the DB.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string HTML view
     * @throws \ReflectionException
     */
    public function handleSignUp()
    {
        //Array to store the errors.
        $errors = [];

        //New user model is created.
        $userModel = new UserModel();

        //The data introduced in the form is collected.
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $repeatPassword = $this->request->getPost('repeat_password');
        $usernameInput = trim($this->request->getPost('username'));
        $username = !empty($usernameInput) ? $usernameInput : explode('@', $email)[0];

        //Errors to check from email introduced.
        if (empty($email)) {
            $errors['email'] = lang('register.email_invalid');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = lang('register.email_invalid');
        } elseif (!preg_match('/@(students\.salle\.url\.edu|ext\.salle\.url\.edu|salle\.url\.edu)$/', $email)) {
            $errors['email'] = lang('register.email_domain');
        } elseif ($userModel->where('email', $email)->first()) {
            $errors['email'] = lang('register.email_registered');
        }

        //Errors to check from the password introduced.
        if (empty($password)) {
            $errors['password'] = lang('register.password_required');
        } elseif (strlen($password) < 8) {
            $errors['password'] = lang('register.password_short');
        } elseif (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $password)) {
            $errors['password'] = lang('register.password_weak');
        }

        //Errors to check from repeated password.
        if (empty($repeatPassword)) {
            $errors['repeat_password'] = lang('register.repeat_required');
        } elseif ($repeatPassword !== $password) {
            $errors['repeat_password'] = lang('register.repeat_mismatch');
        }

        //The introduced picture is validated to check if it is valid, extension and size.
        $profilePicPath ='/IMAGES/default_image.png';
        $file = $this->request->getFile('profile_pic');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $maxSize = 2 * 1024 * 1024;
            $extension = strtolower($file->getClientExtension());
            $allowed = ['jpg', 'jpeg', 'png'];

            if (!in_array($extension, $allowed)) {
                $errors['profile_pic'] = lang('register.invalid_extension');
            } elseif ($file->getSize() > $maxSize) {
                $errors['profile_pic'] = lang('register.file_too_large');
            } else {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newName);
                $profilePicPath = $newName;
            }
        } else {
            $profilePicPath = '/IMAGES/default_image.png';
        }

        //If there are errors the view is rendered again.
        if (!empty($errors)) {
            return view('signUp', [
                'errors' => $errors,
                'old' => $this->request->getPost()
            ]);
        }

        //If there are not errors the user info will be saved into the DB.
        $userModel->save([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'username' => $username,
            'profile_pic' => $profilePicPath
        ]);

        //The sign in is rendered if there are not errors.
        return redirect()->route('sign-in.get')->with('message', lang('register.account_created'));
    }

    /**
     * Method that handles showing the sign in.
     *
     * @return string HTML view
     */
    public function signIn()
    {
        return view('signIn', [
            'errors' => session()->getFlashdata('errors'),
            'old' => session()->getFlashdata('old'),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    /**
     * Method that handles the sign in of the user into the app. Managing the pertinent errors.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function handleSignIn()
    {
        //Empty array with the errors.
        $errors = [];

        //The introduced info of the form is collected.
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        //New user model is created.
        $userModel = new UserModel();

        //Errors of the introduced email.
        if (empty($email)) {
            $errors['email'] = lang('register.email_required');
        }

        //Errors of the introduced password.
        if (empty($password)) {
            $errors['password'] = lang('register.email_required');
        }

        //If there are not errors we will check the info from the DB.
        if (!isset($errors['email']) && !isset($errors['password'])) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = lang('register.email_invalid');
            } else {
                $user = $userModel->where('email', $email)->first();
                if (!$user || !password_verify($password, $user['password'])) {
                    $errors['password'] = lang('register.login_invalid');;
                }
            }
        }

        //If there are errors we will be redirected to the same page.
        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors)->with('old', ['email' => $email]);
        }

        //Session is initialized.
        $session = session();
        $session->set([
            'loggedIn'     => true,
            'user_id'        => $user['id'],
        ]);

        //We are redirected to homepage.
        return redirect()->route('home.get');
    }

    /**
     * Method that allows the user to delete their account.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse HTML view
     */
    public function deleteAccount()
    {
        //Collect email from session.
        $session = session();
        $email = $session->get('email');

        //If there is email the account is destroyed.
        if ($email) {
            $userModel = new UserModel();
            $userModel->where('email', $email)->delete();

            $session->destroy();
            return redirect()->route('landing-page.get')->with('message', lang('register.account_deleted'));
        }

        //We return to the landing page.
        return redirect()->route('landing-page.get')->with('message', lang('account_delete_failed'));
    }

    /**
     * Method that destroys the user's session.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse HTML view
     */
    public function logout()
    {
        //The session is destroyed and we go to landing page.
        $session = session();
        $session->destroy();
        return redirect()->route('landing-page.get');
    }
}
