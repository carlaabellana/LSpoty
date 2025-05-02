<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class LandingPage_Controller extends Controller {

    public function index() {
        $session = session();

        //An array that will store the variables of the view.
        $landingPage_data = [];

        echo view('LandingPage_View', $landingPage_data);
    }



}