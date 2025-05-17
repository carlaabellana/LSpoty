<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Controller that manages showing the landing page to the user.
 */
class LandingPage_Controller extends Controller {

    /**
     * Method that will render the landing page.
     *
     * @return void HTML with the landing page.
     */
    public function index() {
        $session = session();
        echo view('LandingPage_View');
    }



}