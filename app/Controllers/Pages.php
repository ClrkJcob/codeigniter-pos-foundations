<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('Pages/home');
    }

    public function about()
    {
        return view('Pages/about');
    }
}