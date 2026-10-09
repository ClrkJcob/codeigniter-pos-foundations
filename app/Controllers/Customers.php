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
}