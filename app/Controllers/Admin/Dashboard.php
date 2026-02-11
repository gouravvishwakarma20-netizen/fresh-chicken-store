<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $productModel = new ProductModel();

        $stats = $orderModel->getOrderStats();
        $stats['total_products'] = $productModel->countAll();

        $recentOrders = $orderModel->orderBy('created_at', 'DESC')->findAll(10);

        return view('admin/dashboard', [
            'title'        => 'Dashboard',
            'stats'        => $stats,
            'recentOrders' => $recentOrders,
        ]);
    }
}
