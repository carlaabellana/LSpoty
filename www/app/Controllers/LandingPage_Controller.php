<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class LandingPage_Controller extends Controller {

    public function index() {
        $session = session();

        echo view('LandingPage_View');
    }



}