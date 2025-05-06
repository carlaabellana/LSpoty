<?php

namespace App\Controllers;

class HomePageController extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('HomePage');
    }
}
