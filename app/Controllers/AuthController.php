<?php

namespace App\Controllers;

use App\Models\UserModel;


class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/customers');
        }

        return view('auth/login');
        
    }
    public function authenticate()
{
    $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    if (! $this->validate($rules)) {
        return redirect()
            ->to('/login')
            ->withInput()
            ->with('error', 'Username and password are required.');
    }

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $model = new UserModel();
    $user = $model->where('username', $username)->first();

    if (! $user || ! password_verify($password, $user['password'])) {
        return redirect()
            ->to('/login')
            ->withInput()
            ->with('error', 'Invalid username or password.');
    }

    $session = session();
    $session->regenerate(true);

    $session->set([
        'userId'     => $user['id'],
        'username'   => $user['username'],
        'full_name'  => $user['full_name'],
        'isLoggedIn' => true,
    ]);

    return redirect()->to('/customers');
}
public function logout()
{
    session()->destroy();

    return redirect()
        ->to('/login')
        ->with('success', 'You have been logged out successfully.');
}
}