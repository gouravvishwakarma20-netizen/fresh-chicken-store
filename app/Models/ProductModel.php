<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category', 'name', 'slug', 'description', 'price', 'unit', 'image', 'is_available'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAvailableProducts()
    {
        return $this->where('is_available', 1)
                    ->orderBy('category', 'ASC')
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    public function getCategories()
    {
        return $this->select('category')
                    ->where('is_available', 1)
                    ->groupBy('category')
                    ->orderBy('category', 'ASC')
                    ->findAll();
    }

    public function getProductsByCategory(string $category)
    {
        return $this->where('category', $category)
                    ->where('is_available', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
}
