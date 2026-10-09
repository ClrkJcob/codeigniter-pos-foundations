<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function index()
    {
        $saleModel = new SaleModel();

        $sales = $saleModel
            ->select(
                'sales.*, products.name AS product_name,
                customers.full_name AS customer_name,
                users.username AS staff_username'
            )
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left')
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->findAll();

        return view('sales/index', [
            'sales' => $sales,
        ]);
    }

    public function create()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $products = $productModel
            ->where('stock_quantity >', 0)
            ->orderBy('name', 'ASC')
            ->findAll();

        $customers = $customerModel
            ->orderBy('full_name', 'ASC')
            ->findAll();

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'product_id' => 'required|is_not_unique[products.id]',
                'customer_id' => 'permit_empty|is_not_unique[customers.id]',
                'quantity' => 'required|integer|greater_than[0]',
            ];

            if (! $this->validate($rules)) {
                return view('sales/form', [
                    'validation' => $this->validator,
                    'error' => null,
                    'products' => $products,
                    'customers' => $customers,
                    'sale' => $this->request->getPost(),
                ]);
            }

            $productId = (int) $this->request->getPost('product_id');
            $customerId = $this->request->getPost('customer_id');
            $customerId = $customerId === '' ? null : (int) $customerId;
            $quantity = (int) $this->request->getPost('quantity');

            $product = $productModel->find($productId);

            if (! $product) {
                return view('sales/form', [
                    'validation' => null,
                    'error' => 'The selected product was not found.',
                    'products' => $products,
                    'customers' => $customers,
                    'sale' => $this->request->getPost(),
                ]);
            }

            if ($quantity > (int) $product['stock_quantity']) {
                return view('sales/form', [
                    'validation' => null,
                    'error' => 'Not enough stock available for this product.',
                    'products' => $products,
                    'customers' => $customers,
                    'sale' => $this->request->getPost(),
                ]);
            }

            $db = db_connect();
            $db->transBegin();

            $updated = $productModel
                ->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
                ->where('id', $productId)
                ->where('stock_quantity >=', $quantity)
                ->update();

            if (! $updated || $db->affectedRows() !== 1) {
                $db->transRollback();

                return view('sales/form', [
                    'validation' => null,
                    'error' => 'The sale could not be completed because the stock changed.',
                    'products' => $products,
                    'customers' => $customers,
                    'sale' => $this->request->getPost(),
                ]);
            }

            $saleModel = new SaleModel();

            $inserted = $saleModel->insert([
                'product_id' => $productId,
                'customer_id' => $customerId,
                'sold_by' => session()->get('userId'),
                'quantity' => $quantity,
                'total_price' => $product['price'] * $quantity,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($inserted === false || $db->transStatus() === false) {
                $db->transRollback();

                return view('sales/form', [
                    'validation' => null,
                    'error' => 'The sale could not be saved.',
                    'products' => $products,
                    'customers' => $customers,
                    'sale' => $this->request->getPost(),
                ]);
            }

            $db->transCommit();

            return redirect()
                ->to('/sales')
                ->with('success', 'Sale recorded successfully.');
        }

        return view('sales/form', [
            'validation' => null,
            'error' => null,
            'products' => $products,
            'customers' => $customers,
            'sale' => [],
        ]);
    }
}