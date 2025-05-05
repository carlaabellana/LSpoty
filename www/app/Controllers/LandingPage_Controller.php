<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class LandingPage_Controller extends Controller {

    public function index() {
        $session = session();

        //An array that will store the variables of the view.
        $landingPage_data = [
            'title'        => lang('landing.title'),
            'subtitle'     => lang('landing.subtitle'),
            'btn_signin'   => lang('landing.btn_signin'),
            'btn_register' => lang('landing.btn_register'),
            'stat_tracks'  => lang('landing.stat_tracks'),
            'stat_hours'   => lang('landing.stat_hours'),
            'about_heading'=> lang('landing.about_heading'),
            'about_intro'  => lang('landing.about_intro'),
            'feature_1'    => lang('landing.feature_1'),
            'feature_2'    => lang('landing.feature_2'),
            'feature_3'    => lang('landing.feature_3'),
            'feature_4'    => lang('landing.feature_4'),
            'join_us'      => lang('landing.join_us'),
        ];

        echo view('LandingPage_View', $landingPage_data);
    }



}