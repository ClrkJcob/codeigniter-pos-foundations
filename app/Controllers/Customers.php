<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $customers = $customerModel
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('customers/index', [
            'customers' => $customers
        ]);
    }
    public function create()
{
    $model = new \App\Models\CustomerModel();

if (strtolower($this->request->getMethod()) === 'post') {
        $rules = [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return view('customers/form', [
                'validation' => $this->validator,
                'customer'   => $this->request->getPost(),
            ]);
        }

        $model->insert([
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers');
    }

    return view('customers/form', [
        'validation' => null,
        'customer'   => [],
    ]);
}
public function edit($id)
{
    $customerModel = new CustomerModel();
    $customer = $customerModel->find($id);

    if (! $customer) {
        return redirect()->to('/customers');
    }

    if (strtolower($this->request->getMethod()) === 'post') {
        $rules = [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return view('customers/form', [
                'validation' => $this->validator,
                'customer'   => array_merge($customer, $this->request->getPost()),
                'formTitle'  => 'Edit Customer',
                'formAction' => 'customers/edit/' . $id,
                'buttonText' => 'Update Customer',
            ]);
        }

        $customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers');
    }

    return view('customers/form', [
        'validation' => null,
        'customer'   => $customer,
        'formTitle'  => 'Edit Customer',
        'formAction' => 'customers/edit/' . $id,
        'buttonText' => 'Update Customer',
    ]);
}
}