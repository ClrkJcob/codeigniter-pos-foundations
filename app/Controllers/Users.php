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
            'users' => $users,
        ]);
    }

    public function create()
    {
        $userModel = new UserModel();

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'full_name' => 'required|min_length[2]|max_length[100]',
                'password' => 'required|min_length[8]|max_length[255]',
                'avatar' => 'permit_empty|is_image[avatar]|ext_in[avatar,jpg,jpeg,png,gif]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/gif]|max_size[avatar,2048]',
            ];

            if (! $this->validate($rules)) {
                return view('users/form', [
                    'validation' => $this->validator,
                    'user' => $this->request->getPost(),
                    'formTitle' => 'Add User',
                    'formAction' => 'users/new',
                    'buttonText' => 'Save User',
                    'isEdit' => false,
                ]);
            }

            $avatarName = null;
            $avatar = $this->request->getFile('avatar');

            if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
                $avatarName = $avatar->getRandomName();
                $uploadPath = FCPATH . 'uploads/avatars';

                if (! is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }

                $avatar->move($uploadPath, $avatarName);

                service('image')
                    ->withFile($uploadPath . DIRECTORY_SEPARATOR . $avatarName)
                    ->fit(200, 200)
                    ->save();
            }

            $userModel->insert([
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
                'password' => password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),
                'avatar' => $avatarName,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/users');
        }

        return view('users/form', [
            'validation' => null,
            'user' => [],
            'formTitle' => 'Add User',
            'formAction' => 'users/new',
            'buttonText' => 'Save User',
            'isEdit' => false,
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
                'username' => 'required|min_length[3]|max_length[50]',
                'full_name' => 'required|min_length[2]|max_length[100]',
                'password' => 'permit_empty|min_length[8]|max_length[255]',
                'avatar' => 'permit_empty|is_image[avatar]|ext_in[avatar,jpg,jpeg,png,gif]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/gif]|max_size[avatar,2048]',
            ];

            if (! $this->validate($rules)) {
                return view('users/form', [
                    'validation' => $this->validator,
                    'user' => array_merge($user, $this->request->getPost()),
                    'formTitle' => 'Edit User',
                    'formAction' => 'users/edit/' . $id,
                    'buttonText' => 'Update User',
                    'isEdit' => true,
                ]);
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
            ];

            $avatar = $this->request->getFile('avatar');

            if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
                $newName = $avatar->getRandomName();
                $uploadPath = FCPATH . 'uploads/avatars';

                if (! is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }

                $avatar->move($uploadPath, $newName);

                service('image')
                    ->withFile($uploadPath . DIRECTORY_SEPARATOR . $newName)
                    ->fit(200, 200)
                    ->save();

                if (! empty($user['avatar'])) {
                    $oldAvatar = $uploadPath . DIRECTORY_SEPARATOR . $user['avatar'];

                    if (is_file($oldAvatar)) {
                        unlink($oldAvatar);
                    }
                }

                $data['avatar'] = $newName;
            }

            $password = $this->request->getPost('password');

            if ($password !== null && $password !== '') {
                $data['password'] = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );
            }

            $userModel->update($id, $data);

            return redirect()->to('/users');
        }

        return view('users/form', [
            'validation' => null,
            'user' => $user,
            'formTitle' => 'Edit User',
            'formAction' => 'users/edit/' . $id,
            'buttonText' => 'Update User',
            'isEdit' => true,
        ]);
    }
}