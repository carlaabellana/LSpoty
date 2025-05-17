<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function signUpGet()
    {
        return view('SignUp', ['errors' => [], 'old' => []]);
    }

    public function signUp()
    {
        $form_labels = [
            'title'          => lang('register.title_register'),
            'email_label'    => lang('register.email_form'),
            'password_label' => lang('register.password_form'),
            'repeat_label'   => lang('register.repeat_form'),
            'btn_register'   => lang('register.btn_form'),
        ];
        return view('signUp', [
            'validation' => \Config\Services::validation(),
            'labels'     => $form_labels,
        ]);
    }
    public function handleSignUp()
    {
        $errors = [];

        $userModel = new UserModel();

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $repeatPassword = $this->request->getPost('repeat_password');
        $usernameInput = trim($this->request->getPost('username'));
        $username = !empty($usernameInput) ? $usernameInput : explode('@', $email)[0];

        if (empty($email)) {
            $errors['email'] = lang('register.email_invalid');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = lang('register.email_invalid');
        } elseif (!preg_match('/@(students\.salle\.url\.edu|ext\.salle\.url\.edu|salle\.url\.edu)$/', $email)) {
            $errors['email'] = lang('register.email_domain');
        } elseif ($userModel->where('email', $email)->first()) {
            $errors['email'] = lang('register.email_registered');
        }

        if (empty($password)) {
            $errors['password'] = lang('register.password_required');
        } elseif (strlen($password) < 8) {
            $errors['password'] = lang('register.password_short');
        } elseif (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $password)) {
            $errors['password'] = lang('register.password_weak');
        }

        if (empty($repeatPassword)) {
            $errors['repeat_password'] = lang('register.repeat_required');
        } elseif ($repeatPassword !== $password) {
            $errors['repeat_password'] = lang('register.repeat_mismatch');
        }

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

        if (!empty($errors)) {
            return view('signUp', [
                'errors' => $errors,
                'old' => $this->request->getPost()
            ]);
        }

        $userModel->save([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'username' => $username,
            'profile_pic' => $profilePicPath
        ]);

        return redirect()->route('sign-in.get')->with('message', lang('register.account_created'));
    }
    public function signIn()
    {
        $form_labels = [
            'title'          => lang('register.title_register'),
            'email_label'    => lang('register.email_form'),
            'password_label' => lang('register.password_form'),
            'btn_login'   => lang('register.btn_login'),
        ];

        return view('signIn', [
            'errors' => session()->getFlashdata('errors'),
            'old' => session()->getFlashdata('old'),
            'message' => session()->getFlashdata('message'),
            'form_labels' => $form_labels,
        ]);
    }

    public function handleSignIn()
    {
        $errors = [];

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();

        if (empty($email)) {
            $errors['email'] = lang('register.email_required');
        }
        if (empty($password)) {
            $errors['password'] = lang('register.email_required');
        }
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

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors)->with('old', ['email' => $email]);
        }

        $session = session();
        $session->set([
            'loggedIn'     => true,
            'user_id'        => $user['id'],
        ]);

        return redirect()->route('home.get');
    }
    public function deleteAccount()
    {
        $session = session();
        $email = $session->get('email');

        if ($email) {
            $userModel = new UserModel();
            $userModel->where('email', $email)->delete();

            $session->destroy();
            return redirect()->route('landing-page.get')->with('message', lang('register.account_deleted'));
        }
        return redirect()->route('landing-page.get')->with('message', lang('account_delete_failed'));
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->route('landing-page.get');
    }
}
