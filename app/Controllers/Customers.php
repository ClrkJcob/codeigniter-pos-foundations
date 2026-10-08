<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $customers = [
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'juan@example.com',
                'phone' => '09171234567'
            ],
            [
                'full_name' => 'Maria Santos',
                'email' => 'maria@example.com',
                'phone' => '09181234567'
            ],
            [
                'full_name' => 'Carlos Reyes',
                'email' => 'carlos@example.com',
                'phone' => '09191234567'
            ],
            [
                'full_name' => 'Angela Garcia',
                'email' => 'angela@example.com',
                'phone' => '09201234567'
            ],
            [
                'full_name' => 'Mark Flores',
                'email' => 'mark@example.com',
                'phone' => '09211234567'
            ]
        ];

        return view('customers/index', [
            'customers' => $customers
        ]);
    }
}