<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Checkout extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to(base_url())->with('error', 'Your cart is empty');
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        return view('customer/checkout', [
            'title' => 'Checkout',
            'cart'  => $cart,
            'total' => $total,
        ]);
    }

    public function process()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to(base_url())->with('error', 'Your cart is empty');
        }

        $rules = [
            'customer_name'  => 'required|min_length[2]|max_length[100]',
            'customer_phone' => 'required|min_length[10]|max_length[15]',
            'order_type'     => 'required|in_list[delivery,pickup]',
            'payment_method' => 'required|in_list[cod,upi,card]',
        ];

        if ($this->request->getPost('order_type') === 'delivery') {
            $rules['customer_address'] = 'required|min_length[10]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        $orderData = [
            'customer_name'    => $this->request->getPost('customer_name'),
            'customer_phone'   => $this->request->getPost('customer_phone'),
            'customer_address' => $this->request->getPost('customer_address') ?? '',
            'order_type'       => $this->request->getPost('order_type'),
            'payment_method'   => $this->request->getPost('payment_method'),
            'total_amount'     => $total,
            'notes'            => $this->request->getPost('notes') ?? '',
        ];

        $items = [];
        foreach ($cart as $cartItem) {
            $items[] = [
                'product_id'    => $cartItem['product_id'],
                'product_name'  => $cartItem['name'],
                'product_price' => $cartItem['price'],
                'quantity'      => $cartItem['quantity'],
            ];
        }

        $orderModel = new OrderModel();
        $order = $orderModel->createOrder($orderData, $items);

        if ($order) {
            session()->remove('cart');
            return redirect()->to(base_url('order-success/' . $order['order_number']));
        }

        return redirect()->back()->with('error', 'Failed to place order. Please try again.');
    }

    public function success($orderNumber)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->where('order_number', $orderNumber)->first();

        if (!$order) {
            return redirect()->to(base_url());
        }

        return view('customer/order_success', [
            'title' => 'Order Placed',
            'order' => $order,
        ]);
    }
}
