<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;

class Products extends BaseController
{
    public function index()
    {
        $model = new ProductModel();

        $products = $model
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('products/index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $model = new ProductModel();

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'name' => 'required|min_length[2]|max_length[100]',
                'price' => 'required|decimal|greater_than_equal_to[0]',
                'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
                'image' => 'permit_empty|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]|max_size[image,2048]',
            ];

            if (! $this->validate($rules)) {
                return view('products/form', [
                    'validation' => $this->validator,
                    'product' => $this->request->getPost(),
                ]);
            }

            $imageName = null;
            $image = $this->request->getFile('image');

            if ($image && $image->isValid() && ! $image->hasMoved()) {
                $imageName = $image->getRandomName();
                $image->move(FCPATH . 'uploads/products', $imageName);
            }

            $model->insert([
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock_quantity' => $this->request->getPost('stock_quantity'),
                'image' => $imageName,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/products');
        }

        return view('products/form', [
            'validation' => null,
            'product' => [],
        ]);
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            return redirect()->to('/products');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'name' => 'required|min_length[2]|max_length[100]',
                'price' => 'required|decimal|greater_than_equal_to[0]',
                'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
                'image' => 'permit_empty|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]|max_size[image,2048]',
            ];

            if (! $this->validate($rules)) {
                return view('products/form', [
                    'validation' => $this->validator,
                    'product' => array_merge($product, $this->request->getPost()),
                ]);
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock_quantity' => $this->request->getPost('stock_quantity'),
            ];

            $image = $this->request->getFile('image');

            if ($image && $image->isValid() && ! $image->hasMoved()) {
                $imageName = $image->getRandomName();
                $image->move(FCPATH . 'uploads/products', $imageName);

                if (! empty($product['image'])) {
                    $oldImage = FCPATH . 'uploads/products/' . $product['image'];

                    if (is_file($oldImage)) {
                        unlink($oldImage);
                    }
                }

                $data['image'] = $imageName;
            }

            $model->update($id, $data);

            return redirect()->to('/products');
        }

        return view('products/form', [
            'validation' => null,
            'product' => $product,
        ]);
    }

    public function delete($id)
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to('/products');
        }

        $model = new ProductModel();
        $product = $model->find($id);

        if (! $product) {
            return redirect()->to('/products');
        }

        $saleModel = new SaleModel();

        if ($saleModel->where('product_id', $id)->countAllResults() > 0) {
            return redirect()
                ->to('/products')
                ->with('error', 'This product cannot be deleted because it has sales records.');
        }

        if (! empty($product['image'])) {
            $imagePath = FCPATH . 'uploads/products/' . $product['image'];

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $model->delete($id);

        return redirect()->to('/products');
    }
}