<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UserPageController extends Controller {


    public function index() {
        echo view('UserPage');
    }
}