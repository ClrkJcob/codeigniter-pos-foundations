<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $users = $userModel
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('users/index', [
            'users' => $users
        ]);
    }
    public function create()
{
    $userModel = new \App\Models\UserModel();

    if (strtolower($this->request->getMethod()) === 'post') {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[2]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return view('users/form', [
                'validation' => $this->validator,
                'user'       => $this->request->getPost(),
            ]);
        }

        $userModel->insert([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/users');
    }

    return view('users/form', [
        'validation' => null,
        'user'       => [],
    ]);
}
public function edit($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    if (! $user) {
        return redirect()->to('/users');
    }

    if (strtolower($this->request->getMethod()) === 'post') {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]',
            'full_name' => 'required|min_length[2]|max_length[100]',
'avatar' => 'permit_empty|is_image[avatar]|ext_in[avatar,jpg,jpeg,png]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',        ];

        if (! $this->validate($rules)) {
            return view('users/form', [
                'validation' => $this->validator,
                'user'       => array_merge($user, $this->request->getPost()),
                'formTitle'  => 'Edit User',
                'formAction' => 'users/edit/' . $id,
                'buttonText' => 'Update User',
                'isEdit'     => true,
            ]);
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $newName = $avatar->getRandomName();
            $uploadPath = FCPATH . 'uploads/avatars';

            $avatar->move($uploadPath, $newName);

            service('image')
                ->withFile($uploadPath . DIRECTORY_SEPARATOR . $newName)
                ->fit(200, 200)
                ->save();

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }

    return view('users/form', [
        'validation' => null,
        'user'       => $user,
        'formTitle'  => 'Edit User',
        'formAction' => 'users/edit/' . $id,
        'buttonText' => 'Update User',
        'isEdit'     => true,
    ]);
}
}