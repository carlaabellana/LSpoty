<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function signUp()
    {
        return view('signUp', [
            'validation' => \Config\Services::validation(),
        ]);
    }
    public function handleSignUp()
    {
        $errors = [];

        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $repeatPassword = $this->request->getPost('repeat_password');
        $money = $this->request->getPost('money');


        if (empty($email)) {
            $errors['email'] = "The email address is not valid.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "The email address is not valid.";
        } elseif (!preg_match('/@(students\.salle\.url\.edu|ext\.salle\.url\.edu|salle\.url\.edu)$/', $email)) {
            $errors['email'] = "Only emails from the domain @students.salle.url.edu, @ext.salle.url.edu or @salle.url.edu are accepted.";
        } else {
            if ($userModel->where('email', $email)->first()) {
                $errors['email'] = "The email address is already registered.";
            }
        }

        if (empty($password)) {
            $errors['password'] = "The password must contain at least 8 characters.";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "The password must contain at least 8 characters.";
        } elseif (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $password)) {
            $errors['password'] = "The password must contain both upper and lower case letters and numbers.";
        }

        if ($repeatPassword !== $password) {
            $errors['repeat_password'] = "Passwords do not match.";
        }

        if (!empty($money)) {
            if (!is_numeric($money)) {
                $errors['money'] = "Sorry, the money field must be a number.";
            } elseif ($money < 0 || $money > 2000) {
                $errors['money'] = "Sorry, the amount of money is either below or above the limits.";
            }
        } else {
            $money = 0;
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
            'money' => $money
        ]);
        return redirect()->to('/sign-in')->with('message', 'Account created! You can now log in.');
    }
    public function signIn()
    {
        return view('signIn', [
            'errors' => session()->getFlashdata('errors'),
            'old' => session()->getFlashdata('old'),
            'message' => session()->getFlashdata('message')
        ]);
    }

    public function handleSignIn()
    {
        $errors = [];

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            $errors['email'] = 'Email not found.';
        } elseif (!password_verify($password, $user['password'])) {
            $errors['password'] = 'Incorrect password.';
        }

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors)->with('old', ['email' => $email]);
        }

        $session = session();
        $session->set('email', $email);

        return redirect()->to('/');
    }
    public function deleteAccount()
    {
        $session = session();
        $email = $session->get('email');

        if ($email) {
            $userModel = new UserModel();
            $userModel->where('email', $email)->delete();

            $session->destroy();
            return redirect()->to('/')->with('message', 'Your account has been deleted.');
        }
        return redirect()->to('/')->with('message', 'Unable to delete account.');
    }
}
