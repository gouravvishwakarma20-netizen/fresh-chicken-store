<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $products = $productModel->getAvailableProducts();
        $categories = $productModel->getCategories();

        // Group products by category
        $grouped = [];
        foreach ($products as $product) {
            $grouped[$product['category']][] = $product;
        }

        // Get cart items for qty display
        $cart = session()->get('cart') ?? [];
        $cartItems = [];
        foreach ($cart as $item) {
            $cartItems[$item['product_id']] = $item;
        }

        return view('customer/home', [
            'title'      => 'Home',
            'categories' => $categories,
            'grouped'    => $grouped,
            'cartItems'  => $cartItems,
        ]);
    }
}
