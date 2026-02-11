<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_number', 'customer_name', 'customer_phone', 'customer_address',
        'order_type', 'payment_method', 'total_amount', 'order_status', 'notes'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function createOrder(array $orderData, array $items)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $orderData['order_number'] = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 8));

        $this->insert($orderData);
        $orderId = $this->getInsertID();

        $orderItemModel = new OrderItemModel();
        foreach ($items as $item) {
            $orderItemModel->insert([
                'order_id'      => $orderId,
                'product_id'    => $item['product_id'],
                'product_name'  => $item['product_name'],
                'product_price' => $item['product_price'],
                'quantity'      => $item['quantity'],
                'subtotal'      => $item['product_price'] * $item['quantity'],
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return false;
        }

        return $this->find($orderId);
    }

    public function getOrderStats()
    {
        $db = \Config\Database::connect();

        $totalOrders = $this->countAll();
        $todayOrders = $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults(false);
        $pendingOrders = $this->where('order_status', 'pending')->countAllResults(false);

        $totalRevenue = $db->table('orders')
                          ->selectSum('total_amount')
                          ->where('order_status !=', 'cancelled')
                          ->get()->getRow()->total_amount ?? 0;

        return [
            'total_orders'   => $totalOrders,
            'today_orders'   => $todayOrders,
            'pending_orders' => $pendingOrders,
            'total_revenue'  => $totalRevenue,
        ];
    }
}
