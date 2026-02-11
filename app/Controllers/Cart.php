<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Cart extends BaseController
{
    public function add()
    {
        $json = $this->request->getJSON(true);
        $productId = (int)($json['product_id'] ?? 0);
        $quantity = (int)($json['quantity'] ?? 1);

        if ($productId < 1) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid product']);
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product || !$product['is_available']) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product not available']);
        }

        $cart = session()->get('cart') ?? [];

        // Check if product already in cart
        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += $quantity;
                $item['subtotal'] = $item['price'] * $item['quantity'];
                $found = true;
                $quantity = $item['quantity'];
                break;
            }
        }
        unset($item);

        if (!$found) {
            $cart[] = [
                'product_id' => $productId,
                'name'       => $product['name'],
                'price'      => (float)$product['price'],
                'unit'       => $product['unit'],
                'quantity'   => $quantity,
                'subtotal'   => (float)$product['price'] * $quantity,
            ];
        }

        session()->set('cart', $cart);

        return $this->response->setJSON([
            'success'  => true,
            'quantity' => $quantity,
            'message'  => 'Added to cart',
        ]);
    }

    public function update()
    {
        $json = $this->request->getJSON(true);
        $productId = (int)($json['product_id'] ?? 0);
        $quantity = (int)($json['quantity'] ?? 1);

        $cart = session()->get('cart') ?? [];

        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] = $quantity;
                $item['subtotal'] = $item['price'] * $quantity;
                break;
            }
        }
        unset($item);

        session()->set('cart', $cart);

        return $this->response->setJSON(['success' => true]);
    }

    public function remove()
    {
        $json = $this->request->getJSON(true);
        $productId = (int)($json['product_id'] ?? 0);

        $cart = session()->get('cart') ?? [];
        $cart = array_values(array_filter($cart, fn($item) => $item['product_id'] != $productId));

        session()->set('cart', $cart);

        return $this->response->setJSON(['success' => true]);
    }

    public function clear()
    {
        session()->remove('cart');
        return $this->response->setJSON(['success' => true]);
    }

    public function count()
    {
        $cart = session()->get('cart') ?? [];
        $count = array_sum(array_column($cart, 'quantity'));
        return $this->response->setJSON(['count' => $count]);
    }

    public function contents()
    {
        $cart = session()->get('cart') ?? [];
        $total = array_sum(array_column($cart, 'subtotal'));

        return $this->response->setJSON([
            'items' => $cart,
            'total' => number_format($total, 0),
            'count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }
}
