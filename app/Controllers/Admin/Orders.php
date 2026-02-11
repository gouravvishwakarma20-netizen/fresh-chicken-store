<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Orders extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();

        $status = $this->request->getGet('status');

        if ($status && $status !== 'all') {
            $orders = $orderModel->where('order_status', $status)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();
        } else {
            $orders = $orderModel->orderBy('created_at', 'DESC')->findAll();
        }

        return view('admin/orders/index', [
            'title'         => 'Orders',
            'orders'        => $orders,
            'currentStatus' => $status ?? 'all',
        ]);
    }

    public function view($id)
    {
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $order = $orderModel->find($id);
        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        $items = $orderItemModel->getOrderItems($id);

        return view('admin/orders/view', [
            'title' => 'Order #' . $order['order_number'],
            'order' => $order,
            'items' => $items,
        ]);
    }

    public function updateStatus($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        $newStatus = $this->request->getPost('order_status');
        $validStatuses = ['pending', 'confirmed', 'preparing', 'ready', 'out_for_delivery', 'delivered', 'cancelled'];

        if (!in_array($newStatus, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        $orderModel->update($id, ['order_status' => $newStatus]);

        return redirect()->to(base_url('admin/orders/' . $id))
                         ->with('success', 'Order status updated to ' . ucwords(str_replace('_', ' ', $newStatus)));
    }

    public function delete($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        $orderModel->delete($id);

        return redirect()->to(base_url('admin/orders'))->with('success', 'Order deleted successfully');
    }
}
