<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->orderBy('category', 'ASC')->orderBy('name', 'ASC')->findAll();

        return view('admin/products/index', [
            'title'    => 'Products',
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('admin/products/create', [
            'title' => 'Add Product',
        ]);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'category' => 'required|max_length[50]',
            'price'    => 'required|numeric|greater_than[0]',
            'unit'     => 'required|max_length[30]',
            'image'    => 'is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productModel = new ProductModel();

        $slug = url_title($this->request->getPost('name'), '-', true);
        // Ensure unique slug
        if ($productModel->where('slug', $slug)->first()) {
            $slug .= '-' . time();
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'category'    => $this->request->getPost('category'),
            'slug'        => $slug,
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'unit'        => $this->request->getPost('unit'),
            'is_available' => $this->request->getPost('is_available') ? 1 : 0,
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads', $newName);
            $data['image'] = $newName;
        }

        $productModel->insert($data);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to(base_url('admin/products'))->with('error', 'Product not found');
        }

        return view('admin/products/edit', [
            'title'   => 'Edit Product',
            'product' => $product,
        ]);
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to(base_url('admin/products'))->with('error', 'Product not found');
        }

        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'category' => 'required|max_length[50]',
            'price'    => 'required|numeric|greater_than[0]',
            'unit'     => 'required|max_length[30]',
            'image'    => 'is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'unit'        => $this->request->getPost('unit'),
            'is_available' => $this->request->getPost('is_available') ? 1 : 0,
        ];

        // Update slug if name changed
        if ($product['name'] !== $data['name']) {
            $slug = url_title($data['name'], '-', true);
            if ($productModel->where('slug', $slug)->where('id !=', $id)->first()) {
                $slug .= '-' . time();
            }
            $data['slug'] = $slug;
        }

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image
            if ($product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
                unlink(FCPATH . 'uploads/' . $product['image']);
            }
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads', $newName);
            $data['image'] = $newName;
        }

        $productModel->update($id, $data);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to(base_url('admin/products'))->with('error', 'Product not found');
        }

        // Delete image file
        if ($product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
            unlink(FCPATH . 'uploads/' . $product['image']);
        }

        $productModel->delete($id);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product deleted successfully');
    }

    public function toggleAvailability($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return $this->response->setJSON(['success' => false]);
        }

        $productModel->update($id, ['is_available' => $product['is_available'] ? 0 : 1]);

        return redirect()->to(base_url('admin/products'))->with('success',
            $product['name'] . ' is now ' . ($product['is_available'] ? 'unavailable' : 'available'));
    }
}
