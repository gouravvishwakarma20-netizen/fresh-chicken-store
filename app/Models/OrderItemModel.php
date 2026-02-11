<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product_id', 'product_name', 'product_price', 'quantity', 'subtotal'];
    protected $useTimestamps = false;

    public function getOrderItems(int $orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }
}
