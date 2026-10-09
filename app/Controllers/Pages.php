<?php

namespace App\Controllers;

use App\Models\UserModel;

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

    public function profile()
    {
        $userModel = new UserModel();

        $user = $userModel->first();

        return view('profile/index', [
            'user' => $user,
        ]);
    }
}